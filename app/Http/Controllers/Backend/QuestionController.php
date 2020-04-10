<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Experience;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $questions = Question::all();
        return view('backend.pages.question.index')->with(compact('questions'));
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
        return view('backend.pages.question.create')->with(compact('skills', 'experiences'));
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
            'question' => 'required',
        ]);
        $explode = implode(',', $request->expariences);
        $question = new Question();
        $question->question = $request->question;
        $question->skills = $request->skills;
        $question->exparience = $explode;
        $question->save();
        $this->syncAnswer($request, $question->id);
        return redirect('admin/question')->with('message', 'Question created successfully');
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
        return view('backend.pages.question.file_browser')->with(compact('fileNames'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $skills = Skill::all();
        $experiences = Experience::all();
        return view('backend.pages.question.edit')->with(compact('skills', 'question', 'experiences'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question' => 'required',
        ]);
        $explode = implode(',', $request->expariences);
        $question = Question::find($id);
        $question->question = $request->question;
        $question->skills = $request->skills;
        $question->exparience = $explode;
        $question->save();

        $this->syncAnswer($request, $question->id);
        return redirect('admin/question')->with('message', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

    }
    public function delete_question($question_id)
    {
        Question::find($question_id)->delete();
        Answers::where('question_id', $question_id)->delete();

        return redirect('admin/question')->with('message', 'Question deleted successfully');
    }
    public function syncAnswer(Request $request, $question_id)
    {
        $answers = Answers::where('question_id', $question_id)->first();

        if ($answers && !empty($answers)) {
            $answers->answer_1 = $request->answer_1;
            $answers->answer_2 = $request->answer_2;
            $answers->answer_3 = $request->answer_3;
            $answers->answer_4 = $request->answer_4;
            $answers->right_answer = $request->right_answer;
            $answers->save();
        } else {
            $answers = new Answers();
            $answers->question_id = $question_id;
            $answers->answer_1 = $request->answer_1;
            $answers->answer_2 = $request->answer_2;
            $answers->answer_3 = $request->answer_3;
            $answers->answer_4 = $request->answer_4;
            $answers->right_answer = $request->right_answer;
            $answers->save();
        }
    }
}