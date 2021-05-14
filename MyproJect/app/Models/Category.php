<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the posts for the  category.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
	protected $fillable = [
        'name',
    ];
    use HasFactory;
}
