<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filesmodel as fm;
class Filecontroller extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($image->all());
        // dd($image->file('surat'));
        $image = $request->file('surat');
        $originalname=$image->getClientOriginalName();
        $mime = $image->getClientMimeType();
        // newname

        $file = $request->file('surat');
        $ext = $file->getClientOriginalExtension();

        $newName = "berkassuratmasuk_".date('Ymd_His').".".$ext;

        $image->move(public_path().'/berkassuratmasuk/', $newName);
        $filePath= 'berkassuratmasuk/'.$newName;
        //insert


        $suratfile = fm::create([
                                'surat_type' => 'in_ex',
                                'surat_id' => $request->input('surat_id'),
                                'file_path' => $filePath,
                                'file_original'=> $originalname,
                                'mime' => $mime,
                                'keterangan' =>'',
                                ]);

        if($suratfile){
            return redirect('/suratmasuk')->with('status','daa berhasil masuk');
        }

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
        $data = fm::find($id)->delete();
        if($data){
        return response()->json([
             "message" => "records deleted"
             ], 202);
        }else{
        return response()->json([
                "message" => "Files not found"
                ], 404);
        }
       
    }
}
