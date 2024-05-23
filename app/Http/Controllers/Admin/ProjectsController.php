<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Post::all());
        return view('admin.projects.index', ['projects' => Project::orderByRaw('id')->paginate(6)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validate_date = $request->validated();
        $slug = Str::of($request->title)->slug('-');

        $validate_date['slug'] = $slug;

        $img_path = Storage::put('uploads', $request->image_cover);

        $validate_date['image_cover'] = $img_path;

        Project::create($validate_date);
        return to_route('admin.projects.index')->with('message', "New project it's created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {


        $validate_date = $request->validated();
        if ($request->has('image_cover')) {
            if ($project->image_cover) {
                Storage::delete($project->image_cover);
            }

            $img_path = Storage::put('uploads', $request->image_cover);
            $validate_date['image_cover'] = $img_path;
        }

        $project->update($validate_date);

        return to_route('admin.projects.index')->with('message', "Project $project->title updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        if ($project->image_cover) {
            Storage::delete($project->image_cover);
        }

        return to_route('admin.projects.index')->with('message', "Project $project->title deleted!");
    }
}