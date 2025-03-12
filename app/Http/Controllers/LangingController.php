<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Landing;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LangingController extends Controller
{
    public function index($project_id, $id)
    {
        $landingPage = LandingPage::where('project_id', $project_id)->first();
        $landingpage_html = str_replace(
            ['%%id%%', '%%project_id%%', '%%link_registration%%'],
            [$id, $project_id, "/register/$project_id/$id"],
            $landingPage->landingpage_html
        );
        $landingpage_html = preg_replace_callback(
            '/(href|src)="\/?(images|css|js)\//',
            function ($matches) use ($project_id) {
                return $matches[1] . '="/projetos/' . $project_id . '/' . $matches[2] . '/';
            },
            $landingpage_html
        );

        return view('landing.index', compact('landingpage_html'));
    }
}
