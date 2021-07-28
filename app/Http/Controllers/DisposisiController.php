<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelmohon;
use App\Jenissuratmodel;
use App\Pegawaimodel;
use App\Suratmasukmodel;
use App\Filesmodel;
use App\Disposisimodel;
use App\Disposisimohonmomdel as mohonm;
use Carbon\Carbon;
use App\PegawaiDivisimodel as pd;



class DisposisiController extends Controller
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
        $disposisi = Disposisimodel::orderBy('id','desc')->get();
        $map = (object)$disposisi->map(function($item,$i){
                // dd($item->suratmasuk->js['nama_jenis']);
                // dd($item->divisi['nama']);
                $item->namapegawai = $item->pegawai['nama'];
                $item->namadivisi = $item->divisi['nama'];
                $item->perihal =$item->suratmasuk['perihal'];
                $item->dari =$item->suratmasuk['dari'];
                $item->nomer =$item->suratmasuk['nomer_surat'];
                $item->tanggalditerima =$item->suratmasuk['tanggal_surat'];
                $item->jenissurat =$item->suratmasuk->js['nama_jenis'];
                return $item;
        });
        // dd($map);
        return view('pages.disposisi.index',compact('map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mohon = Modelmohon::all();
        return view('pages.disposisi.create',compact('mohon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        // dd($request->all());
        // dd($request->input('kepada_pegawai'));
        $divisi_id = '';
        $now = Carbon::now();
        $pegawai = $request->input('kepada_pegawai');
        // dd($pegawai);
        for($i=0;$i<count($pegawai);$i++){
            $data = Pegawaimodel::where('id','=',$pegawai[$i])->first();
            $divisi[$i] = array($data->pegawaidivisi['divisi_id']); //divisi dimasukkan ke array
            $pegawai[$i] = array($pegawai[$i]);
        }


        for($a=0;$a<count($divisi);$a++){
            $insertDisposisi = Disposisimodel::create([
                                                        'suratmasuk_id' => $request->input('suratmasuk_id'),
                                                        'isidisposisi' => $request->input('isidisposisi'),
                                                         'tanggapan'=> $request->input('tanggapan'),
                                                         'tanggal_disposisi'=> $now,
                                                         'user_id'=>1,
                                                         'to_user'=> $pegawai[$a][0],
                                                         'divisi_id'=> $divisi[$a][0],
                                                            ]);

        }

        //insert mohon 
        //get disposisi nya 
        $disposisiid_mohon = $insertDisposisi->id;
        if(empty($request->input('mohon'))){
                dd("kosong");
        }
        foreach ($request->input('mohon') as $value) {
            $insdispomohon = mohonm::create([
                                                'disposisis_id'=>$disposisiid_mohon,
                                                'mohon_id'=> $value
                                                    ]);
        }
        if($insertDisposisi){
            return redirect('/suratmasuk')->with('status','sukses didisposisikan');

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
        //
    }

    public function disposisike(Request $request){
        // dd($request->segment(3));
        $pegawai = Pegawaimodel::orderBy('nama','asc')->get();
        $mohon = Modelmohon::orderBy('namamohon','asc')->get();
        $surat = Suratmasukmodel::where('id','=',$request->segment(3))->first();
        // dd($surat);
        return view('pages.disposisi.create',compact('surat','pegawai','mohon'));
        
    }
}
