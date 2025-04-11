<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'project_theme';

    protected $fillable = [
        'id',
        'project_id',
        'background_menu',
        'background_top',
        'logo',
        'background_box',
        'background_btn_menu',
        'background_btn_menu_hover',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
