<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function images(){
        return $this->hasMany('App\Models\Image');
    }
    public function discriptions(){
        return $this->hasMany('App\Models\Discription');
    }

    public static function boot(){
        parent::boot();

        static::deleting(function($work){
            $work->images()->delete();
            $work->discriptions()->delete();
        });
    }
}
