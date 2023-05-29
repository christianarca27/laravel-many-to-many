<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $formData = $request->all();
        $this->validation($formData);

        $newProject = new Project();
        $newProject->fill($formData);

        $newProject->slug = Str::slug($newProject->title);

        if ($request->hasFile('preview')) {
            $path = Storage::put('previews', $request->preview);
            $newProject->preview = $path;
        }

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
        $formData = $request->all();
        $this->validation($formData);

        $project->slug = Str::slug($formData['title']);

        if ($request->hasFile('preview')) {
            if ($project->preview) {
                Storage::delete($project->preview);
            }

            $path = Storage::put('previews', $request->preview);
            $project->preview = $path;
        }

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
        if ($project->preview) {
            Storage::delete($project->preview);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($formData)
    {
        $validator = Validator::make(
            $formData,
            [
                'title' => 'required|min:5',
                'type_id' => 'nullable|exists:types,id',
                'technologies' => 'nullable|exists:technologies,id',
                'preview' => 'nullable|image|max:4096',
                'description' => 'required',
                'url' => 'required',
            ],
            [
                'title.required' => 'Campo obbligatorio',
                'type_id.exists' => 'Categoria non esistente',
                'technologies.exists' => 'Tipologia non esistente',
                'title.min' => 'Inserisci almeno 5 caratteri',
                'preview.required' => 'Campo obbligatorio',
                'preview.image' => 'Formato del file non corretto',
                'preview.max' => 'Hai superato il limite di :max KB',
                'preview.required' => 'Campo obbligatorio',
                'description.required' => 'Campo obbligatorio',
                'url.required' => 'Campo obbligatorio',
            ]
        )->validate();

        return $validator;
    }
}
