<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $table = 'landing_pages';

    protected $fillable = [
        'id',
        'landingpage_html',
        'project_id',
        'created_at',
        'updated_at',
    ];
}
