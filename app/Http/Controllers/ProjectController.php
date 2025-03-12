<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::all();


        return view('project.index', compact('projects'));
    }

    public function store(Request $request) {
        $data = $request->only([
            'name',
            'registration_bg',
            'regiatration_fontcolor',
            'registration_boxbgcolor',
        ]);

        $projeto = Project::create($data);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName(); // Gera um nome único
            $request->file('image')->move(public_path('admin/package'), $imageName);

            $data['logo'] = "/projetos"."/$projeto->id" ."/". $imageName;
        }

        return redirect()->route('project.index');
    }
}
