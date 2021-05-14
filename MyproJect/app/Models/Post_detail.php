<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_detail extends Model
{
    protected $table = 'post_details';
    protected $fillable = [
        'content',
        'post_id',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    use HasFactory;
}
