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
		 	<!-- <a href="{{URL::to('/suratmasuk/create')}}"><button class="btn btn-sm btn-relief-primary" style="">+ Surat Masuk</button></a> -->

		 	<!-- open datdatable -->
		 	<table id="example" class="table table-striped table-hover responsive">
		 		<thead>
		            <tr>
		                <th>No</th>
		                <th>Surat Dari</th>
		                <th>Perihal</th>
		                <th>nomer surat</th>
		                <th>Divisi</th>
		                <th>Tanggal Surat</th>
		                <th>Jenis Surat</th>
		                
		                <th></th>
		            </tr>
       			 </thead>
       			 <tbody>
       			 	<?php $i=1?>
			            @foreach($map as $ds)
			            <tr>
			            	<td>{{$i++}}</td>
			            	<td>{{$ds['dari']}}</td>
			            	<td>{{$ds['perihal']}}</td>
			            	<td>{{$ds['nomer']}}</td>
			            	<td>{{$ds['divisi']['nama']}}</td>
			            	<td>{{$ds['tanggalditerima']}}</td>
			            	<td>{{$ds['jenissurat']}}</td>
			            	<td>
			            		
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-float waves-light">Hapus</button>
                                                
                                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-float waves-light">Cetak</button>
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


 </script>



 

@endsection