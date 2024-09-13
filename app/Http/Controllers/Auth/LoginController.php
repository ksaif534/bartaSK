<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Auth,Hash,Storage};
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'     => 'required|max:255',
            'password'  => 'required|max:255'
        ]);
        $user      = DB::table('users')
                    ->where('email',$validated['email'])
                    ->first();
        if ($user) {
            if (filter_var($validated['email'],FILTER_VALIDATE_EMAIL)) {
                $credentials = [
                    'email'     => $validated['email'],
                    'password'  => $validated['password']
                ];
                if (Auth::attempt($credentials)) {
                    DB::table('users')->where('email',$user->email)
                        ->update([
                            'remember_token'    => Hash::make(rand()),
                            'updated_at'        => Carbon::now()
                        ]);
                    return redirect()->route('dashboard.index');
                }else{
                    return back()->with(['msg' => 'Wrong email or password']);
                }
            }else{
                return back()->with(['msg' => 'Email not valid']);
            }
        }else{
            return back()->with(['msg' => 'No User Found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $login)
    {
        $profile = DB::table('users')
                ->where('id', $login)
                ->first();
        return view('dashboard.profile',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $login)
    {
        $profileToEdit = DB::table('users')
                        ->where('id', $login)
                        ->first();
        return view('dashboard.edit-profile',compact('profileToEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $login)
    {
        $validated      = $request->validate([
            'first-name'    => 'required|max:255',
            'last-name'     => 'required|max:255',
            'email'         => 'required|max:255',
            'password'      => 'required|max:255',
            'image'         => 'mimes:jpg,jpeg,png|nullable|max:2048',
            'bio'           => 'required'
        ]);
        if (!empty($validated['image'])) {
            $fileName       = $validated['image']->getClientOriginalName();
            $files          = Storage::files('public');
            $request->image->storeAs('public',$fileName,'local');
        }else{
            $fileName   = DB::table('users')
                        ->where('id',$login)
                        ->first()
                        ->image;
        }
        $updateProfile  = DB::table('users')
                        ->where('id',$login)
                        ->update([
                            'name'      => $validated['first-name'] . " " . $validated['last-name'],
                            'email'     => $validated['email'],
                            'password'  => Hash::make($validated['password']),
                            'image'     => $fileName,
                            'bio'       => $validated['bio']
                        ]);
        if ($updateProfile) {
            return back()->with(['msg' => 'Profile Updated Successfully']);
        }else {
            return back()->with(['msg' => 'Oops, There is problem in Updating the Profile']);
        }
    }

    /**
     * Logut Functionality
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login.create');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
