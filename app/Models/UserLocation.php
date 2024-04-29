<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;
    protected $table= 'user_location';
    protected $fillable = ['lat', 'lang', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
