<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        $categories = Category::all();
        return view('users.forumfeed', compact('posts', 'categories'));
        
    }


    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function downloadFile($filename)
        {
            $filePath = public_path('storage/docs/' . $filename);

            return response()->download($filePath);
        }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $imagePath = 'images/' . $imageName;
        }
        $files = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/docs', $filename);
                
                $files[] = [
                    'name' => $filename,
                    'path' => 'docs/' . $filename,
                ];
            }
        
        
        }
        Post::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'files' => json_encode($files),
        ]);

        return redirect()->route('categories.index')->with('success', 'Post created successfully.');
      
    }
    

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
    
        return view('post.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $imagePath = 'images/' . $imageName;
        }

        $post->update([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        $post->delete();
    
        return Redirect::back()->with('success', 'Post deleted successfully');
    }
}
