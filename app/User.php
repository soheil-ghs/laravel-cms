<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'role_id', 'photo_id',
    'is_active'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function role() {
    return $this->belongsTo(Role::class);
  }

  public function photo() {
    return $this->belongsTo(Photo::class);
  }

  public function isAdmin() {
    if ($this->role->id == 1 && ($this->is_active == 1)) {
      return true;
    }

    return false;
  }

  public function posts() {
    return $this->hasMany(Post::class);
  }
}
