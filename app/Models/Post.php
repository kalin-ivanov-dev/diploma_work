<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected  $guarded = ['id'];
    protected $fillable = ['title','slug','excerpt','body','category_id'];
    protected  $with = ['category','author'];
    public  function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author() // user_id {function name _ id} foreign key
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
