<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminindex()
    {
        $studentCount = User::where('role', 'student')->count();
        $professionalCount = User::where('role', 'professional')->count();
        $categoryCount = Category::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        $topPosts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();
        $topCategories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
    
        return view('admin.dashboard', compact('studentCount', 'professionalCount', 'categoryCount', 'postCount', 'commentCount', 'topPosts', 'topCategories'));
    }
    public function fetchFilteredData(Request $request)
    {
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
    
        $filteredData = [
            'postCount' => Post::whereBetween('created_at', [$startDate, $endDate])->count(),
            'categoryCount' => Category::whereBetween('created_at', [$startDate, $endDate])->count(),
            'commentCount' => Comment::whereBetween('created_at', [$startDate, $endDate])->count(),
            'userCount' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'topPosts' => Post::whereBetween('created_at', [$startDate, $endDate])
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->take(5)
                ->get(),
            'topCategories' => Category::whereBetween('created_at', [$startDate, $endDate])
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->take(5)
                ->get(),
        ];
    
        return response()->json($filteredData);
    }    
    
}