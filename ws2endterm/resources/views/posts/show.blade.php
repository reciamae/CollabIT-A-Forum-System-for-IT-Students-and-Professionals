<div class="post-content">
    <h4 class="post-title"><b>{{ $post->title }}</b></h4>
    <p class="post-description">{{ Str::limit($post->description, 200) }}</p>
</div>

@if($post->image)
    <div align='center'>
        <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="mt-4 inline-block" style="max-width: 500px;">
    </div>
@endif

@include('comments')