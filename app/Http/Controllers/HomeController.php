<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\CommentPhoto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil semua data foto beserta jumlah like untuk setiap foto
        $photos = Photo::withCount('likes')->get();

        // Mengambil semua komentar foto
        $comments = CommentPhoto::all();

        // Mengirimkan data foto dan komentar ke view 'home'
        return view('/home', compact('photos', 'comments'));
    }
}
