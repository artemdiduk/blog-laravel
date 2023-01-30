<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
class Group extends Model
{
    protected $fillable = [
        'name',
        'slag',
        'user_id'
    ];
    use HasFactory;

    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
   
}
