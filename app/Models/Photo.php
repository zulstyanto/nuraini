<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // Mendefinisikan kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = ['title', 'description', 'upload_date', 'image'];

    // Mendefinisikan relasi antara Photo dengan LikePhoto
    public function likes()
    {
        return $this->hasMany(LikePhoto::class);
    }
}

?>
