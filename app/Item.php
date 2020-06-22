<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $fillable = ['kategori_id', 'kode', 'nama', 'satuan'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function itemlokasi()
    {
    	return $this->hasMany(Kategori::class);
    }
}
