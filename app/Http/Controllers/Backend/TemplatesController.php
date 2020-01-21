<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discipline;
use App\Models\Sector;
use App\Models\Segment;
use App\Models\Template;

class TemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::orderBy('id', 'desc')->get();
        return view('backend.pages.template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->select('id', 'name')->get();
        $segments = Segment::orderBy('name', 'asc')->select('id', 'name')->get();
        $sectors = Sector::orderBy('name', 'asc')->select('id', 'name')->get();
        $disciplines = Discipline::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.pages.template.create', compact('categories', 'segments', 'sectors', 'disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'category_id' => 'required',
                'segment_id' => 'required',
                'sector_id' => 'required',
                'discipline_id' => 'required'
            ],
            [
                'name.required' => 'Please give template a name',
                'category_id.required' => 'Please select a category',
                'segment_id.required' => 'Please select a job segment',
                'sector_id.required' => 'Please select a job sector',
                'discipline_id.required' => 'Please select a job discipline'
            ]
        );

        $template = new Template();
        $template->name = $request->name;
        $template->category_id = $request->category_id;
        $template->responsibilities = $request->responsibilities;
        $template->job_summery = $request->job_summery;
        $template->qualification = $request->qualification;
        $template->certification = $request->certification;
        $template->experience = $request->experience;
        $template->about_company = $request->about_company;

        $template->segment_id = $request->segment_id;
        $template->sector_id = $request->sector_id;
        $template->discipline_id = $request->discipline_id;
        $template->save();

        session()->flash('success', 'New Template added successfully');
        return redirect()->route('admin.templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        if (!is_null($template)) {
            return view('backend.pages.template.show', compact('template'));
        }
        session()->flash('error', 'Template not found');
        return redirect()->route('admin.templates.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);
        $categories = Category::orderBy('name', 'asc')->get();
        $segments = Segment::orderBy('name', 'asc')->select('id', 'name')->get();
        $sectors = Sector::orderBy('name', 'asc')->select('id', 'name')->get();
        $disciplines = Discipline::orderBy('name', 'asc')->select('id', 'name')->get();

        if (!is_null($template)) {
            return view('backend.pages.template.edit', compact('template', 'categories', 'segments', 'sectors', 'disciplines'));
        }
        session()->flash('error', 'Template not found');
        return redirect()->route('admin.templates.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $template = Template::find($id);
        if (!is_null($template)) {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'category_id' => 'required',
                    'segment_id' => 'required',
                    'sector_id' => 'required',
                    'discipline_id' => 'required'
                ],
                [
                    'name.required' => 'Please give template a name',
                    'category_id.required' => 'Please select a category',
                    'segment_id.required' => 'Please select a job segment',
                    'sector_id.required' => 'Please select a job sector',
                    'discipline_id.required' => 'Please select a job discipline'
                ]
            );

            $template->name = $request->name;
            $template->category_id = $request->category_id;
            $template->responsibilities = $request->responsibilities;
            $template->job_summery = $request->job_summery;
            $template->qualification = $request->qualification;
            $template->certification = $request->certification;
            $template->experience = $request->experience;
            $template->about_company = $request->about_company;

            $template->segment_id = $request->segment_id;
            $template->sector_id = $request->sector_id;
            $template->discipline_id = $request->discipline_id;

            $template->save();
            session()->flash('success', 'Template has been updated');
        } else {
            session()->flash('error', 'Template not found');
        }

        return redirect()->route('admin.templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        if (!is_null($template)) {
            $template->delete();
        }

        session()->flash('success', 'Template has been deleted successfully !!');
        return back();
    }
}