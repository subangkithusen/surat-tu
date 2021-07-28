@extends('layouts.app2')

@section('konten')

<div class="row">
	<!-- Modal -->
   <div class="modal fade text-left" id="empModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Dokumen / File Download <button class="btn btn-relief-primary " onClick="tambahdokumen()">Tambah Dok</button></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<form action="{{url('/berkas')}}" method="post" class="form" enctype="multipart/form-data">
      		{{csrf_field()}}
      		<input type="hidden" name="surat_id" id="surat_id" value=""/>
      		<span id="tambahdokumen"></span>
      	</form>
      	<span id="kontenfile"></span>
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
   </div>
</div>
<div class="row">
	<div class="col-lg-12 col-12">
		<!-- message -->
		@if(session()->has('message'))
    	<div class="alert alert-success">
        {{ session()->get('message') }}
   		 </div>
		@endif
		<!-- end message -->
		 <div class="card" style="padding: 10px">
		 	<a href="{{URL::to('/suratmasuk/create')}}"><button class="btn btn-sm btn-relief-primary" style="">+ Surat Masuk</button></a>

		 	<!-- open datdatable -->
		 	<table id="example" class="table table-striped table-hover responsive">
		 		<thead>
		            <tr>
		                <th>No</th>
		                <th>Surat Dari</th>
		                <th>Perihal</th>
		                <th>Tanggal Diterima</th>
		                <th>Jenis Surat</th>
		                <th>File</th>
		                <th></th>
		            </tr>
       			 </thead>
       			 <tbody>
       			 	<?php $i=1?>
			            @foreach($sm as $dtsuratmasuk)
			            <tr>
			            	<td>{{$i++}}</td>
			            	<td>{{$dtsuratmasuk->dari}}</td>
			            	<td>{{$dtsuratmasuk->perihal}}</td>
			            	<td>{{$dtsuratmasuk->tanggal_diterima}}</td>
			            	<td>
			            		<!-- {{$dtsuratmasuk->jenis_surat}} -->
			            		<?php
			            		$a = \App\Jenissuratmodel::where('id','=',(int)$dtsuratmasuk->jenis_surat)->first();
			            		?>

			            		{!!$a->nama_jenis!!}
			            		
			            	</td>
			            	<td><button onClick="getfile({{$dtsuratmasuk->id}})" type="button" surat_id="{{$dtsuratmasuk->id}}" class="btn btn-icon btn-icon rounded-circle btn-info waves-effect waves-float waves-light" data-toggle="modal" data-backdrop="false" data-target="#backdrop">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                                        </button>
</td>
			            	<td>
			            		<div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" onClick="hapussurat({{$dtsuratmasuk->id}})" class="btn btn-sm  btn-gradient-danger">X</button>
                                                <!-- form ubah -->
                                                <a href="{{url('/suratmasuk/'.$dtsuratmasuk->id)}}" class="btn btn-sm btn-outline-info">Ubah</a>
                                                <!-- end form ubah -->
                                                <!-- fomr disposisi -->
                                                
                                                <a href="{{url('/disposisi/dispose/'.$dtsuratmasuk->id)}}" class="btn btn-sm  btn-outline-success waves-effect" target="blank">Disposisi</a>
                                               
                                                <!-- end form disposisi -->
                                </div>

			            	</td>
			            </tr>
			            @endforeach

			     </tbody>
		 	</table>



		 	<!-- end data table -->
				

		 </div>
	</div>	
</div>

@endsection
@section('js')




 <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <!-- <script src="{{asset('themes/app-assets/js/scripts/components/components-modals.js')}}"></script> -->
 <script type="text/javascript">
 (function (window, document, $) {
  'use strict';
  var url = "{{url('/')}}";
  console.log(url);
  $('#example').DataTable();
  

})(window, document, jQuery);

//disposisi

function disposisi($id){
	alert("test");
}

function tambahdokumen(){
	$('#tambahdokumen').html("")
	$('#kontenfile').html("");
			form = '<div class="form-group">';
				form += '<label for="email-id-column">Upload Dokumen</label>';
					form += '<span id="kotaksurat"></span>';
					form += '<input type="file" id="filesuratmasuk" class="form-control" name="surat" id="name" required style="margin-bottom:10px"/>';
					form += '<button id="tambah" class="btn btn-xs btn-relief-success">Simpan</button>';
			form += '</div>';
			$('#tambahdokumen').append(form)
			console.log("test")
}
function hapussurat(id){//hapus surat masuk
		var id = id;
		swal({
		  title: "Apakah ada yakin ingin menghapus file ini?",
		  text: "Serius, Tolong dipikirkan lagi!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	//ajax
		    let _url = 'suratmasuk/'+id;
		    let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          _token: _token
		        },
		        success: function(response) {
		         console.log(response);
		         location.reload(true);
		        }
		      });
		  	//end ajax
		    swal("Data sudah terhapus!", {
		      icon: "success",
		    });
		    
		  } else {
		    swal("Data tidak jadi  dihapus!");
		  }
		});
		
		
}
function getfile(id){
		$('#tambahdokumen').html("")
		$('#kontenfile').html('');
		var table = '';
		$.ajax({
			type : "GET",
			url : "{{url('/file')}}"+'/'+id,
			success:function(data){
				// $('#empModal').modal('show');
				// $('#surat_id').value = data[0].surat_id
				table = '<table class="table-responsive table-striped table-dark" style="padding:8px">';
						table += '<thead>';
						table += '<tr><td>No</td>';
						table += '<td>Nama File</td>';
						table += '<td></td>';
						table += '<td></td>';
						table += '</tr></thead>';
						table += '<tbody>';
						// perulangan
						var a = 0;
						if(data.length > 0){
							console.log(data[0].surat_id);
							document.getElementById("surat_id").value = data[0].surat_id;
							for(var i =0;i < data.length; i++){
								table += '<tr>';
								table += '<td>'+(a=a+1)+'</td>';
								table += '<td>'+data[i].file_original+'</td>';
								table += '<td style="width:10%"><a href="'+data[i].file_path+'" class="btn btn-relief-success" target="blank">DOWN</a></td>';
								table += '<td style="width:10%"><button class="btn btn-relief-warning" onClick="hapusfile('+data[i].id+')">DEL</button></td>';
								table += '</tr>';
							}								
						}else{
							console.log("data kosong")
						}
						// end perulangan
						table += '</tbody>';
				table += '<table>';
				//kontenfile
				$('#kontenfile').append(table);
				$('#empModal').modal('show');
			}
		});
	}
	// hapus file
	function hapusfile(id){
		var id = id;
		swal({
		  title: "Apakah ada yakin ingin menghapus file ini?",
		  text: "Serius, Tolong dipikirkan lagi!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	//ajax
		    let _url = 'berkas/'+id;
		    let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          _token: _token
		        },
		        success: function(response) {
		         console.log(response);
		        }
		      });
		  	//end ajax
		    swal("Data sudah terhapus!", {
		      icon: "success",
		    });
		    
		  } else {
		    swal("Data tidak jadi  dihapus!");
		  }
		  $('#empModal').modal('hide');
		});
		// alert(id)
	}
 </script>



 

@endsection