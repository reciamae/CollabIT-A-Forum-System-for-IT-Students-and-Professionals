<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('forum.feed', $post->category_id) }}" class="text-blue-600 hover:text-blue-800"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
            Category: {{ \App\Models\Category::find($post->category_id)->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 custom-container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <ul>
                        <li>
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                        <img src="{{ asset('storage/' .$post->user->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;" class="object-cover">
                                        </div>
                                                                
                                <p class="post-info">Posted by: <b>{{ $post->user->name }}</b> - {{ ucfirst($post->user->role) }}<br>
                                    {{ $post->updated_at->diffForHumans() }}</p>
                                    @if ($post->user_id === Auth::user()->id)
                        <div class="ml-auto">
                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                            </div>

                            <div class="p-1 mx-auto ml-4">
                                <div class="post-content">
                                    <h4 class="post-title"><b>{{ $post->title }}</b></h4>
                                    <p class="post-description">{{ $post->description }}</p>
                                </div>
                                @if($post->image)
                                    <div align='center'>
                                        <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="mt-4 inline-block" style="max-width: 200px;">
                                    </div>
                                @endif
                                @if ($post->files && count(json_decode($post->files)) > 0)
                                    <br><div class="alert alert-primary" role="alert">
                                        <ul>
                                            @foreach(json_decode($post->files) as $file)
                                                <li>
                                                    <a href="{{ route('downloadFile', ['filename' => $file->name]) }}" download>{{ $file->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif<br>
                                <div class="flex items-center">
                                    <span class="ml-2 text-black-500"><b>Comments:</b> {{ $post->comments()->count() }}</span>
                                </div>
                                <button id="toggle-comments" class="btn btn-primary mt-4">
                                    <i class="fas fa-comments"></i>
                                    <span class="ml-2">{{ $comments->count() > 0 ? 'Comments' : 'Comments' }}</span>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="comments-section" class="{{ $comments->count() > 0 ? '' : 'hidden' }}">
         @foreach ($comments as $comment)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
            <div class="p-6 text-gray-900">
                <div class="comments-section flex items-start">
                    <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                       @if ($comment->user->profile_picture)
                        <img src="{{ asset('storage/' .$comment->user->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;" class="object-cover">
                        @else
                        <i class="fas fa-user-circle" style="font-size:30px"></i>
                      @endif 
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-center">
                            <div>
                                <p>
                                    <b>{{ $comment->user->name }}</b> - {{ ucfirst($comment->user->role) }}<br>
                                    {{ $comment->updated_at->diffForHumans() }}
                                </p>
                                <p>{{ $comment->content }}</p>
                            </div>
                            @if (auth()->check() && auth()->user()->id === $comment->user->id)
                                <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500"><i class="fa fa-times-circle" style="font-size: 20px;" aria-hidden="true"></i></button>
                                </form>
                            @endif
                        </div>
                        @if($comment->image)
                            <div align='center'>
                                <img src="{{ asset('storage/'.$comment->image) }}" alt="Post Image" class="mt-4 inline-block" style="max-width: 200px;">
                            </div>
                        @endif
                        @if ($comment->files && count(json_decode($comment->files)) > 0)
                        <br>
                        @foreach(json_decode($comment->files) as $filePath)
                            <div class="alert alert-primary" role="alert">
                                <ul>
                                    <li>
                                        <a href="{{ route('downloadFile', ['filename' => $filePath->name]) }}" download>{{ $filePath->name }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($comments->count() === 0)
    <p>No comments available.</p>
@endif

            <div id="comment-form-container" class="mb-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <button id="toggle-comment-form" class="btn btn-primary">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Comment
                        </button>
                        <div id="comment-form" class="hidden mt-2">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                <div class="p-6 text-gray-900">
                                    <form action="{{ route('comments.store', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label><b>Add your comment</b></label>
                                            <textarea name="content" class="form-control" placeholder="Enter your comment"></textarea>
                                            <div class="mt-2">
                                            <div class="custom-file">
                                          <label for="upload-file-input" class="btn btn-primary">
                                                <i class="fa fa-upload" aria-hidden="true"></i> <span id="upload-picture-label">Upload Picture</span>
                                                <input type="file" name="image" class="form-control-file" id="upload-file-input" style="display: none;">
                                            </label>
                        

                                            <label for="upload-files-input" class="btn btn-primary">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> <span id="upload-files-label">Attach Files</span>
                                                <input type="file" name="files[]" class="form-control-file" id="upload-files-input" multiple style="display: none;">
                                            </label>
                          
                                                <button type="submit" class="btn btn-primary send-button">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Post
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="uploaded-image" class="mt-2" align='center'></div><br>
                            <div id="uploaded-files" ></div><br>
                        </div>
                    </div>
                </div>
            </div>
      
<script>
    document.getElementById('upload-file-input').addEventListener('change', function(e) {
        var label = document.getElementById('upload-picture-label');
        var uploadedImageContainer = document.getElementById('uploaded-image');

        if (e.target.files.length > 0) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                uploadedImageContainer.innerHTML = '<img src="' + event.target.result + '" alt="Uploaded Image">';
            };

            reader.readAsDataURL(file);
            label.textContent = 'Change Picture';
            uploadedImageContainer.style.display = 'block';
        } else {
            label.textContent = 'Upload Picture';
            uploadedImageContainer.innerHTML = '';
            uploadedImageContainer.style.display = 'none';
        }
    });

    document.getElementById('upload-files-input').addEventListener('change', function(e) {
        var label = document.getElementById('upload-files-label');
        var uploadedFilesContainer = document.getElementById('uploaded-files');

        if (e.target.files.length > 0) {
            var fileNames = '';

            for (var i = 0; i < e.target.files.length; i++) {
                var file = e.target.files[i];
                fileNames += file.name + ' (' + file.type + ')' + '<br>';
            }

            label.textContent = 'Reattach Files';
            uploadedFilesContainer.innerHTML = fileNames;
            uploadedFilesContainer.style.display = 'block';
            uploadedFilesContainer.classList.add('alert', 'alert-success');
        } else {
            label.textContent = 'Attach Files';
            uploadedFilesContainer.innerHTML = '';
            uploadedFilesContainer.style.display = 'none';
            uploadedFilesContainer.classList.remove('alert', 'alert-success');
        }
    });
</script>


        </script>
            <style>
                .send-button {
                    background-color: #007bff;
                    border-color: #007bff;
                    color: white;
                }

                .send-button:hover {
                    background-color: #0069d9;
                    border-color: #0062cc;
                    color: white;
                }

                .custom-container {
                    margin-left: 100px;
                    margin-right: 150px;
                }

                .post-content,
                .comments-section {
                    margin-bottom: 1rem;
                }

                #toggle-comments {
                    display: block;
                    margin: 0 auto;
                    text-align: center;
                }

                #toggle-comment-form {
                    display: block;
                    margin: 0 auto;
                    text-align: center;
                }

                .submit-button {
                    background-color: #007bff;
                    border-color: #007bff;
                }

                .submit-button:hover {
                    background-color: #007bff;
                    border-color: #007bff;
                    color: white;
                }
            </style>
            <script>
                document.getElementById('toggle-comments').addEventListener('click', function() {
                    var commentsSection = document.getElementById('comments-section');
                    commentsSection.classList.toggle('hidden');
                    var toggleButton = this;
                    toggleButton.innerHTML = commentsSection.classList.contains('hidden') ? '<i class="fas fa-comments"></i>Comments' : '<i class="fas fa-comments"></i>Comments';
                });
                document.getElementById('toggle-comment-form').addEventListener('click', function() {
                    var commentForm = document.getElementById('comment-form');
                    commentForm.classList.toggle('hidden');
                    var toggleButton = this;
                    toggleButton.innerHTML = commentForm.classList.contains('hidden') ? ' <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Comment' : '<i class="fa fa-plus-circle" aria-hidden="true"></i> Add Comment';
                });
            </script>
        </div>
    </div>
</x-app-layout>
