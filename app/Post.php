<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  protected $fillable = [
    'category_id', 'photo_id', 'title', 'body',
    'user_id', 'photo_id', 'category_id'
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function photo() {
    return $this->belongsTo(Photo::class);
  }

  public function category() {
    return $this->belongsTo(Photo::class);
  }
}
