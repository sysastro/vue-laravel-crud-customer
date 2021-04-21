<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $hidden = ["password","created_at", "updated_at"];
  
  protected $guarded = [];
}
