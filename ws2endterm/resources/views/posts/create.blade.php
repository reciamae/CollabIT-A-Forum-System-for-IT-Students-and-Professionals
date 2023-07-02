<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
            

                        <form action="{{ route('posts.store') }}" method="POST" class="form-inline" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_id" class="mb-2">Category:</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title" class="mb-2">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description" class="mb-2">Description:</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div><br>

                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="upload-file-input" class="btn btn-primary">
                                        <i class="fa fa-upload" aria-hidden="true"></i> <span id="upload-picture-label">Upload Picture</span>
                                        <input type="file" name="image" class="form-control-file" id="upload-file-input" style="display: none;">
                                    </label>
                   

                                    <label for="upload-files-input" class="btn btn-primary">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i> <span id="upload-files-label">Attach Files</span>
                                        <input type="file" name="files[]" class="form-control-file" id="upload-files-input" multiple style="display: none;">
                                    </label>
                          

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Post</button>
                        </form>
                    </div>
                </div>
                <div id="uploaded-image" class="mt-2" align='center'></div>
             <div id="uploaded-files" ></div>
            </div>
        </div>
    </div>
</x-app-layout>

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

<style>
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
</style>
