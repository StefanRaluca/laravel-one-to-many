<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'image_cover', 'image_cover', 'description', 'start_date', 'preview_url', 'url_code', 'team_members'];
}