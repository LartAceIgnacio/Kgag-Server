<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\ModelKeys;

class Gag extends Model
{
    public $timestamps = true;
    protected $table = 'gag';

    public static function view()
    {
        $gags = Gag::orderBy('created_at', 'desc')->paginate(10);
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
