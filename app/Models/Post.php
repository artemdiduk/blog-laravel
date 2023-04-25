<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\User;
use App\Models\Comment;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'img',
        'group_id',
        'slag',
        'user_id',
        'slag_group'
    ];
    public function groups() {
        return $this->belongsTo(Group::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public  function comments() {
        return $this->hasMany(Comment::class);
    }
    public function likedUsers() {
        return $this->belongsToMany(User::class, 'users_posts', 'post_id', 'user_id');
    }
}
