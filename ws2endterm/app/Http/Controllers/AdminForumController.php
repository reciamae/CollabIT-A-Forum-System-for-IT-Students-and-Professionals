<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class AdminForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.forums.index', compact('posts'));
    }
  
    public function downloadPostFile($filename)
    {
        $filePath = public_path('storage/docs/' . $filename);

        return response()->download($filePath);
    }

    public function downloadCommentFile($filename)
    {
        $filePath = public_path('storage/docs/' . $filename);

        return response()->download($filePath);
    }

public function showComments(Post $post)
{
    $comments = Comment::where('post_id', $post->id)->get();

    return view('admin.forums.comments', compact('post', 'comments'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
    
    public function destroy(Post $post, Comment $comment = null)
    {
        if ($comment) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully');
        }
    
        $post->delete();
        return redirect()->route('admin.forums.index')->with('success', 'Post deleted successfully');
    }
    
}
