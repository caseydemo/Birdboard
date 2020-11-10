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
        // $projects = Project::all();

        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    /**
     * 
     */
    public function show(Project $project) {
        // $project = Project::findOrFail(request('project')); // route model binding?
        
        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    /*
    *
    */
    public function create() {
        return view('projects.create');
    }


    /**
     * 
     */
    public function store() {

        
        
        // this is causing the error - 10/28/20
        $attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required'
        ]);

        dd($attributes);

        auth()->user()->projects()->create($attributes);

        // Project::create($attributes);
        return redirect('/projects');
    }
}
