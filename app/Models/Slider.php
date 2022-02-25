<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name","title","subtitle","slug","description","status","order"];
    public function getSliderImage()
    {
        return $this->hasMany(Image::class, "img_id","id");
    }
}
