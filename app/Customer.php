<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
