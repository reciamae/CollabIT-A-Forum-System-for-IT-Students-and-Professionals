<x-app-layout>
    
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
    <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('categories.index') ? 'font-bold' : '' }}">
        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    </a>&nbsp; {{ $category->title }}  {{ __('Forum Feed') }}
    
    <form action="{{ route('categories.search', ['category' => $category->id]) }}" method="GET" class="ml-auto">
        <div class="flex items-center">
        <input type="text" name="search" placeholder="Search posts..." class="p-2 border border-gray-300 rounded-l focus:outline-none focus:ring focus:border-blue-300 w-64">
            <button type="submit" class="bg-blue-500 text-white px-2 py-2 rounded-r hover:bg-blue-600 focus:outline-none">Search</button>
        </div>
    </form>
</h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 custom-container">
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
                                <p class="post-info">
                                    Posted by: <b>{{ $post->user->name }} - </b>{{ ucfirst($post->user->role) }}<br>
                                    {{ $post->updated_at->diffForHumans() }}
                                </p>
                                @if ($post->user_id === Auth::user()->id)
                        <div class="ml-auto">
                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <i class="fa fa-times-circle"  style="font-size: 20px;" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                      @endif
                            </div>
                            <div class="p-1 mx-auto ml-4">
                                <div class="post-content">
                                    <h4 class="post-title text-center"><b>{{ $post->title }}</b></h4>

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
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>


    <style>
        .send-button {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .custom-container {
            margin-left: 100px;
            margin-right: 150px;
        }

        .post-content {
            margin-bottom: 1rem;
        }
    </style>
</x-app-layout>
