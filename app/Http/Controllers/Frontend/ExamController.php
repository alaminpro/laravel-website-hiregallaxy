<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Collection;
use App\Models\Result;
use App\Models\UserSkill;
use App\Models\Job;
use Illuminate\Support\Arr;
class ExamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * fronend view
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        return view('frontend.pages.employers.exam.exam',compact('id'));
    }
    /**
     * Display all Question that are available
     *
     * @return \Illuminate\Http\Response
     */
    public function questions($id)
    {
        $questions = [];
        $job_skill = Job::with('skills')->where('id',$id)->first();
       if(!empty($job_skill) ){
            $skills = $job_skill->skills;
            if(count($skills) > 0){
                $skill_id = $skills->pluck('id');
                $all_questions = Question::with('answers')->get();
                    $all_question = [];
                    for($d = 0; $d < count($all_questions); $d++){
                        $skills = $all_questions[$d]['skills'];
                        for($k = 0; $k < count($skills); $k++){
                            $singles = $skills[$k];
                            for($j = 0; $j < count($skill_id); $j++){
                                if($singles == $skill_id[$j]){
                                    $all_question[] = $all_questions[$d];
                                }
                            }

                        }
                    }
                $questions = $this->array_unique_custom($all_question);
                $questions = collect($questions)->random(11);
                $collection = collect($questions);
                $question_pluck_id = $collection->pluck('id');
                $newQuestion = Question::with('answers')->inRandomOrder()->get();
                $new_collection = collect($newQuestion);
                $final = $new_collection->whereNotIn('id', $question_pluck_id);
                if(count($questions) < 11){
                    $question_left = (11 - count($questions));
                    $result = collect($final)->random($question_left);
                    $collect = collect($questions);
                    return $questions = $collect->merge($result);
                }
            }else{
                $questions =  Question::with('answers')->inRandomOrder()->limit(11)->get();
            }
     }





    if(count($questions) >= 11){
            $data = [];
                for($i = 0; $i < count($questions); $i++){
                    $data[$i]['id'] = $questions[$i]->id;
                    $data[$i]['questions'] = $questions[$i]->question;
                    $data[$i]['responses']['answer_1'] = $questions[$i]->answers['answer_1'];
                    $data[$i]['responses']['answer_2'] = $questions[$i]->answers['answer_2'];
                    $data[$i]['responses']['answer_3'] = $questions[$i]->answers['answer_3'];
                    $data[$i]['responses']['answer_4'] = $questions[$i]->answers['answer_4'];
                }
                $withUser = [
                    'id' => auth()->user()->id,
                    'user' => auth()->user()->name,
                    $data
                ];
        return $withUser;
    }
    return response()->json(['error'=> 'error']);
    }
    function array_unique_custom($array, $keep_key_assoc = false){
        $duplicate_keys = array();
        $tmp = array();
        foreach ($array as $key => $val){
            if (is_object($val))
                $val = (array)$val;
            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }
        foreach ($duplicate_keys as $key)
            unset($array[$key]);
        return $keep_key_assoc ? $array : array_values($array);
    }

    /**
     * check authinticate user skill
     *
     */
    public function checkSkill( )
    {
        return auth()->user()->skills;
    }
    /**
     * check Examp Status
     *
     */
    public function examStatus( )
    {
       return Result::where('user_id', auth()->user()->id)->select('job_id')->get();

    }

    /**
     * Store Result data in Result Table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Results(Request $request)
    {
        $collection = collect($request->answer);
        $question_id =  $collection->pluck('id')->all();
        $questions = Question::with('answers')->whereIn('id', $question_id)->get();
        $que_collection = collect($questions);
        $answers =  $que_collection->pluck('answers')->all();
        $right_answer = [];
        for($i = 0; $i < count($answers); $i++){
           $id = $answers[$i]['question_id'];
           $right_que_answer = $answers[$i]['right_answer'];
            for($j = 0; $j <= $i; $j++){
                $request_id = $request->answer[$j]['id'];
                $request_question = $request->answer[$j]['question'];
                if( $id == $request_id ){
                    if( $right_que_answer ==   $request_question){
                        $right_answer[] = $right_que_answer;
                    }
                }
            }
        }
        // calculation result
        $total_question = $request->total;
        $result_percent = '';
        if(count($right_answer) > 0){
            $result_percent = (count($right_answer)  / $total_question) * 100;
        }else{
            $result_percent = 0;
        }
        $result_percent;
        $total_que = count($right_answer). '/'. $total_question;

        if($request->seconds !== 0){
           $time = gmdate("H:i:s", $request->seconds);
        }else{
           $time = gmdate("H:i:s",1800);
        }

        $Result = new Result();
        $Result->user_id = $request->user_id;
        $Result->job_id = $request->job_id;
        $Result->result = $result_percent;
        $Result->que_answer = $total_que;
        $Result->time = $time;
        $Result->status = 1;
        $Result->save();
        $job_id =   Job::where('id', $request->job_id)->select('slug')->first();
        return response()->json(
            [
                'success'=> 'success',
                'job_id'=> $job_id
            ]
        );

    }

        /**
     * Display a final Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowResult()
    {
        $result = Result::where('user_id', auth()->user()->id)->where('status', 1)->first();

        return view('frontend.pages.employers.exam.exam-result',compact('result'));
    }
}