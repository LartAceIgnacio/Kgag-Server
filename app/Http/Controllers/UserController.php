<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers\ModelKeys;

class UserController extends Controller
{
	 /**
	 * GET method
     * view the users information via username
     * 
     * parameters 
     * $userName 
     */
	public function viewAction($userName)
	{
		$json_return = array(
            'data' => User::findbyUserName($userName)
        );

		return response()->json($json_return);
	}

	/**
	 * POST method
     * Insert user in database.
     * 
     * parameters 
     * $request
     */
	public function addAction(Request $request)
	{
		$data = $request->json()->get(ModelKeys::User);
		$input = User::findbyUserName($data[ModelKeys::username]);

		$json_return;

		if (!$input->isEmpty()) {
			$json_return = array (
				ModelKeys::is_existing => 1
				);
		} else {
			$user = User::addUser($data);
			$json_return = array (
				ModelKeys::User => $user
				);	
		}

		return response()->json($json_return);
	}
}