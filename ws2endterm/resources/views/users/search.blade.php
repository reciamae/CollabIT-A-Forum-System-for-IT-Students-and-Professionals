<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('forum.feed', $category->id) }}" :class="{'font-bold': request()->routeIs('forum.feed', ['category' => $category->id])}">
                <i class="fa fa-chevron-circle-left text-blue-600 hover:text-blue-800" aria-hidden="true"></i>
            </a>&nbsp; {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 custom-container">
            @if ($posts->isEmpty())
                <p>No search results found.</p>
            @else
            <p>Showing {{ $posts->count() }} Search Results.</p>

                @foreach($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-black-900">
                            <ul>
                                <li>
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                        @if($post->user->profile_picture)
                                    <img src="{{ asset('storage/' .$post->user->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;" class="object-cover">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size:30px"></i>
                                    @endif 
                                        </div>
                                        <p class="post-info">Posted by: {{ $post->user->name }}<br>
                                        {{ $post->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="p-1 mx-auto ml-4">
                                        <div class="post-content">
                                            <h4 class="post-title"><b>{{ $post->title }}</b></h4>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="ml-2 text-black-500"><b>Comments:</b> {{ $post->comments()->count() }}</span>
                                        </div>
                                        <div align='center'><a href="{{ route('comments.index', ['post' => $post->id]) }}" class="btn btn-primary">View Post and Comments</a></div> 
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }} 
            @endif
        </div>
    </div>
</x-app-layout>
