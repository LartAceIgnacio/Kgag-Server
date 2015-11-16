<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Gag;
use App\Http\Models\Upload;
use App\Http\Models\User;
use App\Http\Helpers\ModelKeys;

use zgldh\UploadManager\UploadManager;

class GagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function uploadPhotoAction(Request $request)
    {
        DB::beginTransaction();

        $photo = $request->file('photo');
        $manager = UploadManager::getInstance();
        $upload = $manager->upload($photo);
        $upload->name = pathinfo($upload->path, PATHINFO_FILENAME);
        $upload->save();

        DB::commit();

        $data = $request->input(ModelKeys::gag);   
        $data[ModelKeys::upload_id] = $upload[ModelKeys::id];
        $gag = Gag::add($data);

        $data[ModelKeys::gag] = $gag;
        $json_return[ModelKeys::data] = $data;

        return response()->json($json_return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {
        $data = $request->json()->get(ModelKeys::gag);
        $gag = Gag::add($data);

        $data[ModelKeys::gag] = $gag;
        $json_return[ModelKeys::data] = $data;

        return response()->json($json_return);
    }

    public function viewAction()
    {
        $gags = Gag::view();

        foreach ($gags as $gag) {
            $upload = new Upload;
            $upload = $upload::view($gag[ModelKeys::upload_id]);
            $gag[ModelKeys::upload] = $upload;

            $user = User::findById($gag[ModelKeys::user_id]);
            $gag[ModelKeys::User] = $user;
        }

        return response()->json($gags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
