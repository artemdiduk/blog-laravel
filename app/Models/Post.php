<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\User;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'img',
        'group_id',
        'slag',
        'user_id'
    ];
    public function groups() {
        return $this->belongsTo(Group::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
