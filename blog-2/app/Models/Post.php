<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //protected $fillable = ['title', 'excerpt', 'body'];
    protected $guarded = [];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        $query ->when($filters['search'] ?? false, fn($query, $search) =>

         $query->where(fn($query) =>
           $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%')
      )
      );

      $query->when($filters['category'] ?? false,fn($query, $category)=>
        $query->whereHas('author', fn($category) =>
             $query->where('username', $author)
        
        
        ) 
          
      );

      $query->when($filters['author'] ?? false,fn($query, $author)=>
        $query->whereHas('category', fn($category) =>
             $query->where('slug', $category)
        
        
        ) 
          
      );
        

    }
    public function comments(){

      return $this->hasMany(Comment::class);
  }
    
    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function author(){

        return $this->belongsTo(User::class, 'user_id');
    }
    
}
