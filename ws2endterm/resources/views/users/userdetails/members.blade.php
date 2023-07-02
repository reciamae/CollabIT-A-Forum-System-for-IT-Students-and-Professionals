<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">


            {{ __('Collab Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Students</h3>
                    <div id="students" class="mt-4 mb-4"> 
                        @forelse ($students as $student)
                        <a href="{{ route('users.userdetails.details', ['userId' => $student->id]) }}" class="card" data-id="{{ $student->id }}">
                            <div class="flex items-center px-4 mt-3 mb-3">
                            <div class="rounded-full overflow-hidden mr-2">
                                    @if ($student->profile_picture)
                                        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture" class="object-cover w-8 h-8">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size:30px"></i>
                                    @endif
                                </div>
                                <h4>{{ $student->name }}</h4>
                                @if ($student->id === Auth::id())
                                    <span class="text-xs ml-2 bg-green-500 text-white px-2 py-1 rounded">You</span>
                                @endif
                            </div>
                        </a>
                        @empty
                        <p>No student members yet.</p><br>
                        @endforelse
                    </div>
                    <h3 class="text-lg font-semibold mt-6 mb-2">Professionals</h3>
                    <div id="professionals">
                    @forelse ($professionals as $professional)
                        <a href="{{ route('users.userdetails.details', ['userId' => $professional->id]) }}" class="card" data-id="{{ $professional->id }}">
                            <div class="flex items-center px-4 mt-3 mb-3">
                            <div class=" rounded-full overflow-hidden mr-2">
                            @if ($professional->profile_picture)
                                <img src="{{ asset('storage/' . $professional->profile_picture) }}" alt="Profile Picture" class="object-cover w-full h-full">
                            @else
                                <i class="fas fa-user-circle" style="font-size:30px"></i>
                         
                        </div>
                        @endif
                        <h4>{{ $professional->name }}</h4>
                        @if ($professional->id === Auth::id())
                            <span class="text-xs ml-2 bg-green-500 text-white px-2 py-1 rounded">You</span>
                        @endif
                        </div>
                        </a>
                        @empty
                  <p>No professional members yet.</p>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
