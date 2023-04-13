<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'img',
        'post_id',
        'user_id',
        'active'

    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function posts() {
        return $this->belongsTo(Post::class);
    }
}
