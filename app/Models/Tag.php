<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model 
{
    use HasFactory;

    protected $table = 'tags';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'user_id'

    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}