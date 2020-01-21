<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\JobActivity;
use App\Models\SiteReview;

use App\User;
use Auth;

class APIController extends Controller
{
    public function getJobActivity(Request $request, $job_id, $user_id)
    {
        $job_activity = JobActivity::where('user_id', $user_id)->where('job_id', $job_id)->first();
        return json_encode(['status' => 'success', 'data'=>$job_activity]);
    }  

    public function addReview(Request $request)
	{
		$api_token = $request->get('api_token');
		$user = User::where('api_token', $api_token)->first();
		if (!is_null($user->api_token)) {

			$review = new SiteReview();
			
			if ($user->is_company) {
				$review->name = $request->get('name');
				$review->position = $request->get('position');
				$review->company = $user->name;
			}else{
				$review->name = $user->name;
				$review->position = $user->currentJob()->job_title;
				$review->company = $user->currentJob()->company_name;
			}
			
			
			if ($user->profile_picture == null) {
				$review->profile_picture = 'user.png';
			}else{
				$review->profile_picture = $user->profile_picture;
			}
			$review->facebook_link = $user->facebook_link;
			$review->twitter_link = $user->twitter_link;
			$review->linkedin_link = $user->linkedin_link;
			$review->is_confirmed = 1;
			$review->review = $request->get('review');
			$review->save();

			return json_encode(['status' => 'success', 'message' => 'Your review has been taken successfully !!']);
		}else{
			return json_encode(['status' => 'error', 'message' => 'Not Authenticated']);
		}
	}

}
