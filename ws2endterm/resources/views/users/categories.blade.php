                <x-app-layout>
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Categories') }}
                        </h2>
                    </x-slot>
                  
                            <div class="py-12">
                            @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                                @foreach($categories as $category)
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900" style="display: flex; justify-content: space-between;">
                                            <a href="{{ route('forum.feed', $category->id) }}" :class="{'font-bold': request()->routeIs('forum.feed', ['category' => $category->id])}">
                            {{ $category->title }}
                        </a>

                        <span>Posts: {{ $category->posts->count() }}</span>

                    </div>
                </div>
            </div><br>
        @endforeach
    </div>
</x-app-layout>
