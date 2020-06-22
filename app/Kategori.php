<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['keterangan'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
