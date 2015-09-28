<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Models\User;

class UserController extends Controller
{
	public function getAllUsers() 
	{
		return response()->json(User::findAll());
	}

	public function getUserById($id)
	{
		return response()->json(User::findById($id));
	}

	public function getUserByUserName($userName)
	{
		return response()->json(User::findbyUserName($userName));
	}

	public function insertUser()
	{
		$user = User::addUser();
		return response()->json($user);
	}
}