<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
    //protected $table = 'posts';

    //protected $fillable = ['name','description']; //post::create column name that want to store

    public function categories()
        {
            return $this->belongsTo('App\Models\Category', 'category_id');
        }
}
