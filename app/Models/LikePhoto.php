<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePhoto extends Model
{
    use HasFactory;

    // Mendefinisikan kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'photo_id', 'user_id', 'like_date',
    ];

    // Mendefinisikan relasi antara LikePhoto dengan Photo
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    // Mendefinisikan relasi antara LikePhoto dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>
