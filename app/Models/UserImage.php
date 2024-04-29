<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserImage extends Model
{
    use HasFactory;
    protected $table = 'user_images';
    protected $fillable = ['image', 'user_id'];

    public function getImageAttribute($value)
    {
        return ($value) ? Storage::disk('public')->url($value) : $value;
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
