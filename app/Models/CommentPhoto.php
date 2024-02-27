<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentPhoto extends Model
{
    // Mendefinisikan kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = ['photo_id', 'user_id', 'comment_content', 'comment_date'];

    // Mendefinisikan relasi antara CommentPhoto dengan Photo
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    // Mendefinisikan relasi antara CommentPhoto dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

