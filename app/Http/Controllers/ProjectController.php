<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Project;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $projects = Project::all();
        return view('admin.projects.index', compact('projects', 'project'));
    }

    public function list()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function profile($id)
    {
        $project = Project::find($id);
        $documents = Documents::where('project_id', $id)->orderBy('id', 'DESC')->get();

        return view('projects.profile', compact('project', 'documents'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'description',
            'regiatration_fontcolor',
            'registration_boxbgcolor',
        ]);

        if ($request->project_id) {
            Project::where('id', $request->project_id)->update($data);
            $projeto = Project::find($request->project_id);
        } else {
            $projeto = Project::create($data);
        }
        // Diretório do projeto
        $projectPath = public_path("projetos/{$projeto->id}");

        // Se a pasta não existir, cria com permissão 0777
        if (!File::exists($projectPath)) {
            File::makeDirectory($projectPath, 0777, true, true);
        }

        if ($request->hasFile('logo')) {
            $imageName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($projectPath, $imageName);
            $projeto->logo = "/projetos/{$projeto->id}/{$imageName}";
            $projeto->save();
        }

        if ($request->hasFile('registration_bg')) {
            $imageName = time() . '_' . $request->file('registration_bg')->getClientOriginalName();
            $request->file('registration_bg')->move($projectPath, $imageName);
            $projeto->registration_bg = "/projetos/{$projeto->id}/{$imageName}";
            $projeto->save();
        }

        return redirect()->route('admin.projects.index');
    }
}
