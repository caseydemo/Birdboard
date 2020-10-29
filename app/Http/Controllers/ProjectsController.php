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

        
        // this is causing the error - 10/28/20
        $attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required',
            'owner_id'  =>  'required'
            ]);

        
        // $attributes['owner_id'] = auth()->id();

        auth()->user()->projects()->create($attributes);

        Project::create($attributes);
        return redirect('/projects');
    }
}
