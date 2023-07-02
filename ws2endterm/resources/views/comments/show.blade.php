<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 custom-container">
            <h3>Comments:</h3>
            @foreach ($comments as $comment)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                <img src="{{ asset('storage/images/avatar.png') }}" alt="Profile Picture" class="object-cover">
                            </div>
                            <p class="comment-author">Posted by: {{ $comment->user->name }}</p>
                        </div>
                        <div class="comment-content">
                            <p class="comment-body">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .custom-container {
            margin-left: 100px;
            margin-right: 150px;
        }

        .comment-content {
            margin-bottom: 1rem;
        }
    </style>
</x-app-layout>






