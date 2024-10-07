<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Hash};

class ProfileController
{
    /**
     * Display the specified user profile resource.
     */
    public function show(string $profile)
    {
        $profile = DB::table('users')
            ->where('id', $profile)
            ->first();

        return view('dashboard.profile', compact('profile'));
    }

    /**
     * Show the form for editing the specified user profile resource.
     */
    public function edit(string $profile)
    {
        $profileToEdit = DB::table('users')
            ->where('id', $profile)
            ->first();

        return view('dashboard.edit-profile', compact('profileToEdit'));
    }

    /**
     * Update the specified user profile resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'username' => 'required|max:255',
                'email' => 'required|max:255',
                'password' => 'required|max:255',
                'image' => 'mimes:jpg,jpeg,png|nullable|max:2048',
                'bio' => 'required',
            ]
        );
        if (! empty($validated['image'])) {
            $fileName = $validated['image']->getClientOriginalName();
            $request->image->storeAs('public', $fileName, 'local');
        } else {
            $fileName = $profile->image;
            // $fileName = DB::table('users')
            //     ->where('id', $login)
            //     ->first()
            //     ->image;
        }
        $updateProfile = $profile->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'image' => $fileName,
            'bio' => $validated['bio'],
        ]);
        // $updateProfile = DB::table('users')
        //     ->where('id', $login)
        //     ->update(
        //         [
        //             'name' => $validated['name'],
        //             'username' => $validated['username'],
        //             'email' => $validated['email'],
        //             'password' => Hash::make($validated['password']),
        //             'image' => $fileName,
        //             'bio' => $validated['bio'],
        //         ]
        //     );
        if ($updateProfile) {
            return back()->with(['msg' => 'Profile Updated Successfully']);
        } else {
            return back()->with(['msg' => 'Oops, There is problem in Updating the Profile']);
        }
    }
}
