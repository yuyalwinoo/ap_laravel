<?php

namespace App\Models;

use App\Mail\PostStored;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    //protected $fillable = ['name','description']; 
    //post::create column name that want to store
    protected $guarded = []; //to store all field

    public function categories()
        {
            return $this->belongsTo('App\Models\Category', 'category_id');
        }

    protected static function booted(){
        static::created(function ($post){
           // dd('created hook from post model');
           Mail::to('yuyal1593@gmail.com')->send(new PostStored($post));//markdown
        });
    }    
}
