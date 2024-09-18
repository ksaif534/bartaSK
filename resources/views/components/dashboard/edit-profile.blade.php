<x-dashboard.layout>
    <x-slot name="editProfile">
        <!-- Profile Edit Form -->
        @if (request()->session()->has('msg'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('msg') }}</span> 
            </div>
        @else
        
        @endif
      <form action="{{ route('profiles.update',auth()->user()->id ) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-xl font-semibold leading-7 text-gray-900">
              Edit Profile
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
              This information will be displayed publicly so be careful what you
              share.
            </p>

            <div class="mt-10 border-b border-gray-900/10 pb-12">

              <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                  <label
                    for="first-name"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Name</label
                  >
                  <div class="mt-2">
                    <input
                      type="text"
                      name="name"
                      id="name"
                      autocomplete="name"
                      value="{{ auth()->user()->name }}"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-full">
                  <label
                    for="username"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Username</label
                  >
                  <div class="mt-2">
                    <input
                      id="username"
                      name="username"
                      type="text"
                      autocomplete="username"
                      value="{{ auth()->user()->username }}"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="col-span-full">
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
                      value="{{ auth()->user()->email }}"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="col-span-full">
                  <label
                    for="password"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Password</label
                  >
                  <div class="mt-2">
                    <input
                      type="password"
                      name="password"
                      id="password"
                      autocomplete="password"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="col-span-full">
                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900">
                        Upload Your Image
                    </label>
                    <div class="mt-2">
                        <input type="file" name="image" id="image" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                    </div>
                    <br>
                    @if (auth()->user()->image)
                        <p class="mb-3 text-gray-500 dark:text-gray-400">
                            Current File: 
                            <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ \Storage::url(auth()->user()->image) }}" target="_blank">
                                View File/Image
                            </a>
                        </p>
                        <p class="mb-3 text-gray-500 dark:text-gray-400">If you don't upload a new file, the current one will remain unchanged.</p>
                    @endif
                </div>
              </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="col-span-full">
                <label
                  for="bio"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Bio</label
                >
                <div class="mt-2">
                    <textarea
                    id="bio"
                    name="bio"
                    rows="5"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                        {{ auth()->user()->bio }}
                    </textarea
                  >
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600">
                  Write a few sentences about yourself.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button
            type="button"
            class="text-sm font-semibold leading-6 text-gray-900">
            Cancel
          </button>
          <button
            type="submit"
            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Save
          </button>
        </div>
        <br>
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
      <!-- /Profile Edit Form -->
    </x-slot>
</x-dashboard.layout>