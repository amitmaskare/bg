<?php

// app/Models/CmsPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    protected $table = 'cms_pages';

    protected $fillable = ['title', 'slug', 'content'];
}

?>