<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h2 class="text-2xl font-semibold mb-4">Welcome to CollabIT</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($features as $feature)
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 flex items-center justify-center bg-gray-200 rounded-md">
                                            <i class="{{ $feature['icon'] }} fa-lg text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold">{{ $feature['title'] }}</h3>
                                            <p class="text-gray-700">{{ $feature['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md p-10">
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-1">
                @if($topCategories->count() > 0)
                    <h2 class="text-xl font-semibold mb-4">Top Categories</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($topCategories as $category)
                            <div class="bg-white p-3 rounded-lg shadow-md mb-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 flex items-center justify-center bg-gray-200 rounded-md">
                                        <i class="far fa-folder fa-lg text-gray-500"></i>
                                    </div>
                                    <div class="ml-2">
                                        <h3 class="text-base font-semibold">{{ $category->name }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $category->posts_count }} post{{ $category->posts_count !== 1 ? 's' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No top categories available.</p>
                @endif
            </div>

            <div class="col-span-1">
                @if($topPosts->count() > 0)
                    <h2 class="text-xl font-semibold mb-4">Top Posts</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($topPosts as $post)
                            <div class="bg-white p-3 rounded-lg shadow-md mb-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 flex items-center justify-center bg-gray-200 rounded-md">
                                        <i class="far fa-file-alt fa-lg text-gray-500"></i>
                                    </div>
                                    <div class="ml-2">
                                        <h3 class="text-base font-semibold">{{ $post->title }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $post->comments_count }} comment{{ $post->comments_count !== 1 ? 's' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No top posts available.</p>
                @endif
            </div>
        </div>
    </div>
</div><br>

</x-app-layout>
