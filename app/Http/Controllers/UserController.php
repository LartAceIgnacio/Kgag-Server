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
		$user = User::findbyUserName($userName);
		$data;

		if ($user)
			$data[ModelKeys::User] = $user;
		else
			$data[ModelKeys::User] = array();

        $json_return[ModelKeys::data] = $data;

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

		if ($input) {
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

	/**
	 * POST method
     * Verify user credentials (username and password)
     * 
     * parameters 
     * $request
     */
	public function verifyAction(Request $request)
	{
		
		$data = $request->json()->get(ModelKeys::User);
		$userData = $request->input('User');

		$username = $data[ModelKeys::username];
		$password = $data[ModelKeys::password];

		$user = User::findByLoginCredentials($username, $password);
		$data;

		if ($user) {
			$data = array (
				ModelKeys::is_valid => 1,
				ModelKeys::User => $user
				);
		} else {
			$data = array (
				ModelKeys::is_valid => 0
				);	
		}

		$json_return[ModelKeys::data] = $data;

		return response()->json($json_return);
	}

}