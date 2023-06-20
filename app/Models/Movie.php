<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotes(){
        return $this->hasMany(Quote::class);
    }

    public function getPosterAttribute($value){
        return asset($value);
    }
}
