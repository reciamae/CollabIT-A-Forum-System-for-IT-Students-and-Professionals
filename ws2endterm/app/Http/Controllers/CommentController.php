<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $comments = $post->comments;
        return view('users.comments', compact('comments', 'post'));
    }
    
     function store(Request $request, $postId)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'files.*' => 'nullable|file|max:2048', 
        ]);
    
        $comment = new Comment;
        $comment->content = $validatedData['content'];
        $comment->user_id = auth()->user()->id; 
        $comment->post_id = $postId; 
    
       
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
    
        $comment->files = json_encode($files);
        $comment->image = $imagePath;
        $comment->save();
        return redirect()->back()->with('success', 'Comment created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('users.comments.index', compact('comments', 'post'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function downloadFile($filename)
{
    $filePath = public_path('storage/docs/' . $filename);

    return response()->download($filePath);
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
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
            $comment->delete();
    
        return Redirect::back()->with('success', 'Comment deleted successfully');
    }
}
