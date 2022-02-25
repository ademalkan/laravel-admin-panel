<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ["title", "slug", "content", "status", "published_date", "order"];

    public function getArticleImage()
    {
        return $this->hasMany(Image::class, "img_id", "id");
    }
}
