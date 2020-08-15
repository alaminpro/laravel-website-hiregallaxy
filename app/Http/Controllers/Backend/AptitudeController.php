<?php

namespace App\Http\Controllers\Backend;

use App\Models\Aptitude;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\AptitudeAnswer;
use App\Http\Controllers\Controller;

class AptitudeController extends Controller
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
        if(auth()->user()->hasRole('editor')){
            $aptitudes = Aptitude::where('user_id', auth()->user()->id)->get();
        }else{
            $aptitudes = Aptitude::all();
        } 

      
        return view('backend.pages.aptitude.index')->with(compact('aptitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all();
        $experiences = Experience::all();
        return view('backend.pages.aptitude.create')->with(compact('skills', 'experiences'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'aptitude' => 'required',
        ]);
        $explode = implode(',', $request->expariences);
        $aptitude = new Aptitude();
        $aptitude->aptitude = $request->aptitude;
        $aptitude->skills = $request->skills;
        $aptitude->exparience = $explode;
        $aptitude->user_id = auth()->user()->id;
        $aptitude->save();
        $this->syncAnswer($request, $aptitude->id);
        return redirect('admin/aptitude')->with('message', 'Aptitude created successfully');
    }
    public function upload(Request $request)
    {
        $request->upload->move(public_path('uploads'), $request->file('upload')->getClientOriginalName());
        return json_encode(array('file_name' => $request->file('upload')->getClientOriginalName()));
    }

    public function fileBrowser()
    {
        $paths = glob(public_path('uploads/*'));
        $fileNames = array();
        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }
        return view('backend.pages.aptitude.file_browser')->with(compact('fileNames'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aptitude  $aptitude
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aptitude = Aptitude::with('aptitudeanswers')->where('id', $id)->first();
        return view('backend.pages.aptitude.view',compact('aptitude'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aptitude  $aptitude
     * @return \Illuminate\Http\Response
     */
    public function edit(Aptitude $aptitude)
    {
        $skills = Skill::all();
        $experiences = Experience::all();
        return view('backend.pages.aptitude.edit')->with(compact('skills', 'aptitude', 'experiences'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\aptitude  $aptitude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'aptitude' => 'required',
        ]);
        $explode = implode(',', $request->expariences);
        $aptitude = Aptitude::find($id);
        $aptitude->aptitude = $request->aptitude;
        $aptitude->skills = $request->skills;
        $aptitude->exparience = $explode;
        $aptitude->save();

        $this->syncAnswer($request, $aptitude->id);
        return redirect('admin/aptitude')->with('message', 'Aptitude updated successfully');
    }

    
    public function delete_aptitude($aptitude_id)
    {
        Aptitude::find($aptitude_id)->delete();
        AptitudeAnswer::where('aptitude_id', $aptitude_id)->delete();

        return redirect('admin/aptitude')->with('message', 'Aptitude deleted successfully');
    }
    public function syncAnswer(Request $request, $aptitude_id)
    {
        $answers = AptitudeAnswer::where('aptitude_id', $aptitude_id)->first();

        if ($answers && !empty($answers)) {
            $answers->answer_1 = $request->answer_1;
            $answers->answer_2 = $request->answer_2;
            $answers->answer_3 = $request->answer_3;
            $answers->answer_4 = $request->answer_4;
            $answers->right_answer = $request->right_answer;
            $answers->save();
        } else {
            $answers = new AptitudeAnswer();
            $answers->aptitude_id = $aptitude_id;
            $answers->answer_1 = $request->answer_1;
            $answers->answer_2 = $request->answer_2;
            $answers->answer_3 = $request->answer_3;
            $answers->answer_4 = $request->answer_4;
            $answers->right_answer = $request->right_answer;
            $answers->save();
        }
    }
}
