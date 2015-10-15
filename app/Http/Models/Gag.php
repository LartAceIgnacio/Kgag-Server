<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\ModelKeys;

class Gag extends Model
{
    public $timestamps = false;
    protected $table = 'gag';

    public static function view()
    {
        $gags = Gag::paginate(5);
        return $gags;
    }

    public static function add($data)
    {
    	$gag = new Gag;

    	$gag->message = $data[ModelKeys::message];
        $gag->upload_id = $data[ModelKeys::upload_id];
        $gag->user_id = $data[ModelKeys::user_id];

    	$gag->save();

    	return $gag;
    }


}
