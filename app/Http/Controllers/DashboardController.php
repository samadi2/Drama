<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        return view('dashboard', compact('users', 'posts'));
    }
}
