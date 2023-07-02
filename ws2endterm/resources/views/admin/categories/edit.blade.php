<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                </a>
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-6">
                <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-gray-700 mb-2">Category Name:</label>
                            <input type="text" name="title" id="name" value="{{ $category->title }}" class="form-input mt-1 block w-full px-4 py-2 border rounded-lg" required autofocus>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
