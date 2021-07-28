<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suratmasukmodel as sm;
use App\Jenissuratmodel as js;
use App\Filesmodel as fm;
use DB;

class SuratmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sm = sm::all();
        // dd($js);
        return view ('pages.suratmasuk.index',compact('sm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $js = js::all();
        return view ('pages.suratmasuk.create',compact('js'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->hasfile('filesurat'));
        // dd(count($request->file('filesurat')));
        // dd($request->input('filesurat'));

        // input cek

        //insert suratmasuk
        $insertsurat = sm::create([
                                    'dari' => $request->input('suratdari'),
                                    'no_agenda' => $request->input('nomeragenda'),
                                    'tanggal_surat' => $request->input('tglsurat'),
                                    'tanggal_diterima' => $request->input('tglterima'),
                                    'nomer_surat' => $request->input('nomersurat'),
                                    'perihal' => $request->input('perihal'),
                                    'jenis_surat' => $request->input('jenissurat')
                                    // 'suratdari' => $request->input('filesurat');
                                    ]);
        // dd($insertsurat->id);
        //insert file
        $count = fm::all()->count();
        if($count == 0) {
            $count = 1;
        }else{
            $count = $count;
        }

         if($request->hasfile('filesurat'))
        {
            foreach($request->file('filesurat') as $image)
            {


                $originalname=$image->getClientOriginalName();
                $count = $count + 1;
                // newname
                $file = $request->file('filesurat');
                $ext = $image->getClientOriginalExtension();

                $newName = "berkassuratmasuk_".$count.date('Ymd_His').".".$ext;
                $image->move(public_path().'/berkassuratmasuk/', $newName);
                $filePath= 'berkassuratmasuk/'.$newName;
                $data[] = $newName; 

                $insertfile = fm::create([
                                'surat_type' => 'in',
                                'surat_id' => $insertsurat->id,
                                'file_path' => $filePath,
                                'file_original' => $originalname,
                                'mime' => '',
                                'keterangan' => ''
                                ]);
            }
        }
        if($insertsurat){
            //redirect success
            return redirect('/suratmasuk')->with('status', 'data sudah dimasukkan!');
           
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
        
        $data = sm::where('id','=',$id)->first();
        $js = js::all();
        // dd($data);
        // dd($data->files);
        return view('pages.suratmasuk.show',compact('data','js'));
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
        $data = DB::table('suratmasuks')
                    ->where('id',$id)
                    ->update([
                            'dari' => $request->input('suratdari'),
                            'tanggal_surat' => $request->input('tglsurat'),
                            'tanggal_diterima' => $request->input('tglterima'),
                            'jenis_surat' => $request->input('jenissurat'),
                            'nomer_surat' => $request->input('nomersurat'),
                            'perihal' => $request->input('perihal'),
                            'no_agenda' => $request->input('nomeragenda'),
                            ]);

        if($data){
           return redirect('/suratmasuk')->with('status','data sukses di update');
        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        //Delele surat
        $sm = sm::find($id)->delete();
        $fm = fm::where('surat_id','=',$id)->delete();

        if($fm){
            return response()->json([
             "message" => "records deleted"
             ], 202);
        }else{
        return response()->json([
                "message" => "Files not found"
                ], 404);
        }
   
      
       
    }


    public function getfilesurat($id){
        $data = fm::where('surat_id','=',$id)->get();
        return response()->json($data);

    }
}
