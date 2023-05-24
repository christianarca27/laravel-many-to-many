<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
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

        return view('admin.projects.create', compact('types'));
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
        return view('admin.projects.show', compact('project'));
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

        return view('admin.projects.edit', compact('project', 'types'));
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
                'title' => 'required|unique:projects,title|min:5',
                'type_id' => 'nullable|exists:types,id',
                'date' => 'required',
                'preview' => 'required',
                'description' => 'required',
                'url' => 'required',
            ],
            [
                'title.required' => 'Campo obbligatorio',
                'title.unique' => 'Titolo già presente, scegline un altro',
                'type_id.exists' => 'Categoria non esistente',
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
