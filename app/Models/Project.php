<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'id',
        'name',
        'description',
        'logo',
        'registration_bg',
        'regiatration_fontcolor',
        'registration_boxbgcolor',
        'registration_video',
        'updated_at',
        'created_at',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class, 'project_id', 'id');
    }

    public function landingPages()
    {
        return $this->hasMany(LandingPage::class, 'project_id', 'id');
    }
}
