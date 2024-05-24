<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
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
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(6)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        // dd($types);
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;
        if ($request->hasFile('image_cover')) {
            $img_path = Storage::put('uploads', $request->file('image_cover'));
            $validated_data['image_cover'] = $img_path;
        }

        Project::create($validated_data);
        return to_route('admin.projects.index')->with('message', "New project it's created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        //dd($types);
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        //dd($types);
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {


        $validated_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;
        if ($request->hasFile('image_cover')) {
            if ($project->image_cover) {
                Storage::delete($project->image_cover);
            }
            $img_path = Storage::put('uploads', $request->file('image_cover'));
            $validated_data['image_cover'] = $img_path;
        }
        $project->update($validated_data);
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