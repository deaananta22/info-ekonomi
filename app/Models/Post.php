<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts'; // nama koleksi MongoDB

    protected $fillable = ['title', 'content'];
}