<x-auth.layout>
    <x-slot name="login">
      @if (request()->session()->has('msg'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
          <span class="font-medium">Oops!</span> {{ session('msg') }}
        </div>
      @else
          
      @endif
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a
              href=""
              class="text-center text-6xl font-bold text-gray-900"
              ><h1>Barta</h1></a
            >
    
            <h1
              class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
              Sign in to your account
            </h1>
          </div>
    
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form
              class="space-y-6"
              action="{{ route('login.store') }}"
              method="POST">
              @csrf
              <div>
                <label
                  for="email"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Email address</label
                >
                <div class="mt-2">
                  <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    placeholder="bruce@wayne.com"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
              </div>
    
              <div>
                <div class="flex items-center justify-between">
                  <label
                    for="password"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Password</label
                  >
                  <div class="text-sm">
                    <a
                      href="#"
                      class="font-semibold text-black hover:text-black"
                      >Forgot password?</a
                    >
                  </div>
                </div>
                <div class="mt-2">
                  <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
              </div>

              <!-- Remember me -->
              <div class="flex items-center mb-4">
                <input id="remember" type="checkbox" name="remember" @checked(old('remember')) class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Check me out</label>
              </div>
    
              <div>
                <button
                  type="submit"
                  class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                  Sign in
                </button>
              </div>
              @if ($errors->any())
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                          <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                            <span class="font-medium">Warning alert!</span> {{ $error }}
                          </div>
                        </li>
                    @endforeach
                  </ul>
              @else
                  
              @endif
            </form>
    
            <p class="mt-10 text-center text-sm text-gray-500">
              Don't have an account yet?
              <a
                href="{{ route('register.create') }}"
                class="font-semibold leading-6 text-black hover:text-black"
                >Sign Up</a
              >
            </p>
        </div>
    </x-slot>
</x-auth.layout>