<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForumFeedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminForumController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('users.dashboard');
        }
    })->middleware(['verified'])->name('dashboard');
    Route::patch('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/users/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/users/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/users/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/users/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/users/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/users/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/users/categories/{category}/forumfeed', [ForumFeedController::class, 'show'])->name('forum.feed');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/users/comments/{post}', [CommentController::class, 'show'])->name('users.comments.show');
    Route::get('/users/posts/{post}/comments', [CommentController::class, 'index'])->name('users.comments.index');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{post}', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/comments/{postId}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/categories',  [CategoryController::class, 'index'])->name('categories');


    Route::get('categories/{category}/search', [ForumFeedController::class, 'searchForm'])->name('categories.searchForm');
    Route::get('categories/{category}/search', [ForumFeedController::class, 'search'])->name('categories.search');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::resource('/users/posts', PostController::class);


    Route::get('/download/{filename}', [PostController::class, 'downloadFile'])->name('downloadFile');
    Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    Route::get('/admin/forums', [AdminForumController::class, 'index'])->name('admin.forums.index');
    Route::delete('/admin/forums/{post}', [AdminForumController::class, 'destroy'])->name('admin.forums.destroy');
    Route::delete('/admin/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
    Route::get('/download-post-file/{filename}', [AdminForumController::class, 'downloadPostFile'])->name('downloadPostFile');
    Route::get('/download-comment-file/{filename}', [AdminForumController::class, 'downloadCommentFile'])->name('downloadCommentFile');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  
    Route::get('/fetch-filtered-data', [DashboardController::class, 'fetchFilteredData'])->name('fetch.filtered.data');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminindex'])->name('admin.dashboard');
    
    Route::patch('/profile/update-additional-info', [UserController::class, 'updateAdditionalInfo'])->name('profile.updateAdditionalInfo');


    Route::get('admin/forums/{post}/comments', [AdminForumController::class, 'showComments'])->name('admin.forums.comment');
    Route::get('admin/users/{id}', [AdminController::class, 'showUserDetails'])->name('admin.users.show');
    Route::get('users', [UserDetailsController::class, 'members'])->name('users.userdetails.members');
    Route::get('users/{userId}', [UserDetailsController::class, 'showCollabDetails'])->name('users.userdetails.details');
    
}); 

require __DIR__.'/auth.php';