<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'price',
        'image_url',
        'is_bought',
        'user_id',
        'buyer_id',
    ];

  

      // Свързване на поста с потребителя (автор на поста)
      public function user()
      {
          return $this->belongsTo(User::class);
      }
  
      // Свързване на поста с потребителя, който го е купил (ако има такъв)
      public function buyer()
      {
          return $this->belongsTo(User::class, 'buyer_id');  // посочваме 'buyer_id' като връзка
      }


}
