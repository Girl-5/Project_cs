<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;


    protected $table = self::TABLE;


    protected $fillable = [
               'title',
               'slug',
               'body',
               'author-id',
    ];
}
