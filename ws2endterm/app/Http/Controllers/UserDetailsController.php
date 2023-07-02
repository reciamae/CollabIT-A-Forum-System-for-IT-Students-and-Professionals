<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserDetailsController extends Controller
{
    //
    public function showCollabDetails($userId)
    {
        
        $user = User::findOrFail($userId);
        
        return view('users.userdetails.details', compact('user'));
    }
    public function members()
    {
        $students = User::where('role', 'student')->get();
        $professionals = User::where('role', 'professional')->get();
    
        return view('users.userdetails.members', compact('students', 'professionals'));
    }
    
}
