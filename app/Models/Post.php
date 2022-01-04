<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected  $guarded = ['id'];
    protected $fillable = ['title','slug','excerpt','body','category_id'];
    protected  $with = ['category','author','comments'];
    public  function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author() // user_id {function name _ id} foreign key
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments() // user_id {function name _ id} foreign key
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query,array $filters){

        $query->when($filters['search'] ?? false,function($query,$search){
            $query->where(fn($query) =>
                $query->where('title','like','%' . $search.'%')
                ->orWhere('body','like','%' . $search.'%'));
        });

        $query->when($filters['category'] ?? false,function($query,$category){
            $query->whereHas('category',fn($query)=> $query->where('slug',$category));
        });

        $query->when($filters['author'] ?? false,function($query,$author){
            $query->whereHas('author',fn($query)=> $query->where('username',$author));
        });

    }

}
