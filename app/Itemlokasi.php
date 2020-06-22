<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemlokasi extends Model
{
    protected $table = 'itemlokasi';

    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function lokasi()
    {
    	return $this->belongsTo(Lokasi::class);
    }
}
