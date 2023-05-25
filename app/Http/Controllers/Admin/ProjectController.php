<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $newProject = new Project();

        $formData = $request->all();
        $newProject->fill($formData);

        $newProject->slug = Str::slug($newProject->title);

        $newProject->save();

        if (array_key_exists('technologies', $formData)) {
            $newProject->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $technologies = $project->technologies;

        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request);

        $formData = $request->all();
        $formData['slug'] = Str::slug($formData['title']);

        $project->update($formData);

        if (array_key_exists('technologies', $formData)) {
            $project->technologies()->sync($formData['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation(Request $request)
    {
        $formData = $request->all();

        $validator = Validator::make(
            $formData,
            [
                'title' => 'required|min:5',
                'type_id' => 'nullable|exists:types,id',
                'technologies' => 'nullable|exists:technologies,id',
                'date' => 'required',
                'preview' => 'required',
                'description' => 'required',
                'url' => 'required',
            ],
            [
                'title.required' => 'Campo obbligatorio',
                'type_id.exists' => 'Categoria non esistente',
                'technologies.exists' => 'Tipologia non esistente',
                'title.min' => 'Inserisci almeno 5 caratteri',
                'date.required' => 'Campo obbligatorio',
                'preview.required' => 'Campo obbligatorio',
                'description.required' => 'Campo obbligatorio',
                'url.required' => 'Campo obbligatorio',
            ]
        )->validate();

        return $validator;
    }
}
