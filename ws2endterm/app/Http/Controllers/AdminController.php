<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showUserDetails($id)
{
    $user = User::find($id);

    if (!$user) {
        abort(404); // Or handle the error as per your preference
    }

    return view('admin.users.user-details', compact('user'));
}
  
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $users = User::where('role', '!=', 'admin')->get();
            return view('admin.users.index', compact('users'));
        } else {
    
            $features = [
                [
                    'icon' => 'fa fa-users',
                    'title' => 'Collaboration',
                    'description' => 'Connect and collaborate with a community of IT students and professionals in real-time.'
                ],
                [
                    'icon' => 'fa fa-share',
                    'title' => 'Sharing',
                    'description' => 'Effortlessly share your work with others.'
                ],
                [
                    'icon' => 'fa fa-question',
                    'title' => 'Question & Answer',
                    'description' => 'Ask questions and get answers quickly.'
                ],
                [
                    'icon' => 'fa fa-book',
                    'title' => 'Learning Resources',
                    'description' => 'Empower your learning journey with a wide range of educational content designed to support your growth in the IT field.'
                ],
            ];
    
            $topPosts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();
    
            $topCategories = Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(5)
                ->get();
    
            return view('users.dashboard', compact('features', 'topPosts', 'topCategories'));
        }
    }
    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            $users = User::where('role', '=', 'admin')->get();
            return view('admin.users.index', compact('users'));
        } else {
            $user = auth()->user();
            $features = [
                [
                    'icon' => 'fa fa-users',
                    'title' => 'Collaboration',
                    'description' => 'Connect and collaborate with a community of IT students and professionals in real-time.'
                ],
                [
                    'icon' => 'fa fa-share',
                    'title' => 'Sharing',
                    'description' => 'Effortlessly share your work with others.'
                ],
                [
                    'icon' => 'fa fa-question',
                    'title' => 'Question & Answer',
                    'description' => 'Ask questions and get answers quickly.'
                ],
                [
                    'icon' => 'fa fa-book',
                    'title' => 'Learning Resources',
                    'description' => 'Empower your learning journey with a wide range of educational content designed to support your growth in the IT field.'
                ],
            ];
    
            $topPosts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();
    
            $topCategories = Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(5)
                ->get();
    
            return view('users.dashboard', compact('user', 'features', 'topPosts', 'topCategories'));
        }
    }
    

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
      
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            $students = User::where('role', 'student')->get();
            $professionals = User::where('role', 'professional')->get();
    
            return view('admin.users.user-details', compact('user', 'students', 'professionals'));
        } else {

            $user = auth()->user(); 
    
            $features = [
                [
                    'icon' => 'fa fa-users',
                    'title' => 'Collaboration',
                    'description' => 'Connect and collaborate with a community of IT students and professionals in real-time.'
                ],
                [
                    'icon' => 'fa fa-share',
                    'title' => 'Sharing',
                    'description' => 'Effortlessly share your work with others.'
                ],
                [
                    'icon' => 'fa fa-question',
                    'title' => 'Question & Answer',
                    'description' => 'Ask questions and get answers quickly.'
                ],
                [
                    'icon' => 'fa fa-book',
                    'title' => 'Learning Resources',
                    'description' => 'Empower your learning journey with a wide range of educational content designed to support your growth in the IT field.'
                ],
            ];
        
            $topPosts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();
        
            $topCategories = Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(5)
                ->get();
            return view('users.dashboard', compact('user', 'features', 'topPosts', 'topCategories'));
        }
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role === 'admin') {
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::find($id);
    
            if ($user) {
                $user->delete();
        
                return redirect()->route('admin.users.index')->with('success', 'User has been deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            abort(403);
        }
    }
    
}
