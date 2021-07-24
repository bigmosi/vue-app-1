<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\File;

class Post 
{
    public static function all() {
       
      return array_map(fn($file)=>$file->getContents(), $files);
            
    }
    
   public static function find($slug)
   {
      
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
       
        throw new ModelNotFoundExeception();
    }

      return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path)); 


   }

}
