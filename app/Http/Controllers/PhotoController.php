<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\LikePhoto;
use Illuminate\Http\Request;

class PhotoController extends Controller
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
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'upload_date' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk file gambar
        ]);

      // Jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {
          // Buat nama baru untuk file gambar dengan menggunakan timestamp
            $imageName = time() . '.' . $request->image->extension();

          // Pindahkan file gambar yang diunggah ke direktori public/images dengan nama yang baru
        $request->image->move(public_path('images'), $imageName);
        }

      // Buat entri baru dalam tabel Photo dengan data yang diterima dari request
        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'upload_date' => $request->upload_date,
            'image' => $imageName ?? null, // Simpan nama file gambar jika ada, jika tidak kosongkan
        ]);

      // Redirect pengguna ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Photo upload successfully.');
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

    public function like(Request $request, Photo $photo)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id yang diberikan valid dan ada di dalam tabel users
        ]);

        // Cek apakah pengguna sudah menyukai foto tersebut sebelumnya
        $existingLike = LikePhoto::where('photo_id', $photo->id)
                                ->where('user_id', $request->user_id)
                                ->first();

        // Jika belum, buat entri baru di tabel LikePhoto untuk menandai bahwa pengguna menyukai foto ini
        if (!$existingLike) {
            $like = new LikePhoto();
            $like->photo_id = $photo->id;
            $like->user_id = $request->user_id;
            $like->like_date = now();
            $like->save();

            return redirect()->back()->with('success', 'Photo liked successfully');
        } else {
            // Jika sudah, hapus entri like yang terkait
            $existingLike->delete();
            
            return redirect()->back()->with('success', 'Photo unliked successfully');
        }
    }
}
