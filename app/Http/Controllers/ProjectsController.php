<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    /**
     * 
     */
    public function index() {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * 
     */
    public function show(Project $project) {
        // $project = Project::findOrFail(request('project')); // route model binding?
        return view('projects.show', compact('project'));
    }

    /**
     * 
     */
    public function store() {

        dd('poop?');

        $attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required',
            'owner_id'  =>  'required'
            ]);

        $attributes['owner_id'] = auth()->id();
        Project::create($attributes);
        return redirect('/projects');
    }
}
