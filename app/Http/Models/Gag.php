<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\ModelKeys;

class Gag extends Model
{
    public $timestamps = false;
    protected $table = 'gag';

    public static function add($data)
    {
    	$gag = new Gag;

    	$gag->message = $data[ModelKeys::message];
    	$gag->user_id = $data[ModelKeys::user_id];

    	$gag->save();

    	return $gag;
    }

}
