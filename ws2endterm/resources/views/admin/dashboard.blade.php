<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }} - {{ date('F j, Y h:i:s A') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
            
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-500 rounded-full p-3">
                            <i class="fas fa-user-graduate text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-900 font-bold text-lg">Students</div>
                            <div class="text-gray-600 student-count">{{ $studentCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-500 rounded-full p-3">
                            <i class="fas fa-user-tie text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-900 font-bold text-lg">Professionals</div>
                            <div class="text-gray-600 professional-count">{{ $professionalCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="start-date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start-date" name="start-date"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="end-date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="end-date" name="end-date"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-purple-500 rounded-full p-3">
                            <i class="fas fa-file-alt text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-900 font-bold text-lg">Posts</div>
                            <div class="text-gray-600 post-count">{{ $postCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-red-500 rounded-full p-3">
                            <i class="fas fa-comment text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-900 font-bold text-lg">Comments</div>
                            <div class="text-gray-600 comment-count">{{ $commentCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 rounded-full p-3">
                            <i class="fas fa-list-alt text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-900 font-bold text-lg">Categories</div>
                            <div class="text-gray-600 category-count">{{ $categoryCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="grid grid-cols-2 gap-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-900 font-bold text-lg">Top Posts</div>
            <div class="text-right">Comments</div>
        </div>
        <ul class="top-posts">
            @foreach ($topPosts as $post)
                <li>
                    <div class="flex items-center justify-between">
                        <div>{{ $post->title }}</div>
                        <div class="text-right">{{ $post->comments_count }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-900 font-bold text-lg">Top Categories</div>
            <div class="text-right">Posts</div>
        </div>
        <ul class="top-categories">
            @foreach ($topCategories as $category)
                <li>
                    <div class="flex items-center justify-between">
                        <div>{{ $category->title }}</div>
                        <div class="text-right">{{ $category->posts_count }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

</x-app-layout>
<style>
    
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var startDateInput = document.getElementById('start-date');
        var endDateInput = document.getElementById('end-date');

        startDateInput.addEventListener('change', fetchData);
        endDateInput.addEventListener('change', fetchData);

        function fetchData() {
            var startDate = startDateInput.value;
            var endDate = endDateInput.value;

            var url = "{{ route('fetch.filtered.data') }}";
            url += "?start-date=" + startDate + "&end-date=" + endDate;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    
                updateData(data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
        function updateData(data) {
    var postCountElement = document.querySelector('.post-count');
    postCountElement.textContent = data.postCount;
    var categoryCountElement = document.querySelector('.category-count');
    categoryCountElement.textContent = data.categoryCount;
    var commentCountElement = document.querySelector('.comment-count');
    commentCountElement.textContent = data.commentCount;
    var topPostsElement = document.querySelector('.top-posts');
    topPostsElement.innerHTML = ''; 

    data.topPosts.forEach(function (post) {
        var listItem = document.createElement('li');
        listItem.textContent = post.title + ' (' + post.comments_count + ' comments)';
        topPostsElement.appendChild(listItem);
    });
    var topCategoriesElement = document.querySelector('.top-categories');
    topCategoriesElement.innerHTML = ''; 
    data.topCategories.forEach(function (category) {
        var listItem = document.createElement('li');
        listItem.textContent = category.title + ' (' + category.posts_count + ' posts)';
        topCategoriesElement.appendChild(listItem);
    });
}

    });
</script>
