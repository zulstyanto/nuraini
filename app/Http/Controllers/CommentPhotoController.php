<?php

namespace App\Http\Controllers;

use App\Models\CommentPhoto;
use Illuminate\Http\Request;

class CommentPhotoController extends Controller
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
        // Validasi data yang diterima dari request
        $request->validate([
            'photo_id' => 'required|exists:photos,id', // Pastikan photo_id yang diberikan valid dan ada di dalam tabel photos
            'user_id' => 'required|exists:users,id',   // Pastikan user_id yang diberikan valid dan ada di dalam tabel users
            'comment_content' => 'required|string',    // Pastikan comment_content tidak boleh kosong dan berupa string
        ]);

        // Buat entri baru dalam tabel CommentPhoto dengan data yang diterima dari request
        CommentPhoto::create([
            'photo_id' => $request->photo_id,           // Assign photo_id dari request ke kolom photo_id dalam tabel CommentPhoto
            'user_id' => $request->user_id,             // Assign user_id dari request ke kolom user_id dalam tabel CommentPhoto
            'comment_content' => $request->comment_content, // Assign comment_content dari request ke kolom comment_content dalam tabel CommentPhoto
            'comment_date' => now(),                     // Assign waktu saat ini ke kolom comment_date dalam tabel CommentPhoto
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Comment added successfully');
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
    public function destroy(string $id)
    {
        //
    }
}
