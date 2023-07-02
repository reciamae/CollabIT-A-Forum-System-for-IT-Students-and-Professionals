<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
class ForumFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
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


    public function search(Request $request, Category $category)
    {
        $searchQuery = $request->input('search');

        $posts = $category->posts()
            ->where('title', 'like', '%' . $searchQuery . '%')
            ->paginate(5);

        return view('users.search', compact('category', 'posts', 'searchQuery'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(5);

        return view('users.forumfeed', compact('category', 'posts'));
    }
    public function feed()
    {
    $posts = Post::paginate(5);
    return view('forumfeed.feed', compact('posts'));
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
    public function destroy(string $id)
    {
        //
    }
}
