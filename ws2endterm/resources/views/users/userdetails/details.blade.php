<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('users.userdetails.members') }}" class="text-blue-600 hover:text-blue-800">
  <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
</a>
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-20 h-20 rounded-full overflow-hidden">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="object-cover w-full h-full">
                        </div>
                    </div>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>User Type:</strong> {{ $user->role }}</p>
                    <p><strong>Institution/Organization:</strong> {{ $user->ins_org }}</p>
                    <p><strong>Qualification/Education:</strong> {{ $user->quali_educ }}</p>
                    <p><strong>Skills:</strong> {{ $user->skills }}</p>
                    <p><strong>Experience:</strong> {{ $user->experience }}</p>
                    <p><strong>Contact No.:</strong> {{ $user->contact_no }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
