@extends('layouts.app2')

@section('konten')
<!-- modal file -->
 <div class="modal fade text-left" id="filedokumen" role="dialog">
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
<!-- end modal file -->
<div class="row">
		<!-- <div class="row"> -->
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title">Ubah Surat Masuk </h4><button  onclick="goBack()" class="btn btn-sm btn-primary">Kembali</button>
	            </div>
	            <div class="card-body">
	                <form action="{{route('suratmasuk.update',$data['id'])}}" method="post" class="form" enctype="multipart/form-data">
	                	 {{ csrf_field() }}
	                	 {{ method_field('PUT') }}

	                    <div class="row">
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="first-name-column">Surat Dari /RS /SATKER /PT </label>
	                                <input type="text" id="first-name-column" class="form-control" placeholder="RS XXXXXXXX" name="suratdari" value="{{$data['dari']}}"/>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="last-name-column">No Agenda (Saat ini)</label>
	                                <input type="text" id="last-name-column" class="form-control" placeholder="Nomer Agenda" name="nomeragenda" value="{{$data['no_agenda']}}"/>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="city-column">Tanggal Surat</label>
	                                <input type="text"  name="tglsurat" class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD" value="{{$data['tanggal_surat']}}" >
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="city-column">Tanggal Terima Surat </label>
	                                <input type="text"  name="tglterima" class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD" value="{{$data['tanggal_diterima']}}">
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="country-floating">Nomer Surat</label>
	                                <input type="text" id="country-floating" class="form-control" name="nomersurat" placeholder="Nomer Surat" value="{{$data['nomer_surat']}}"/>
	                            </div>
	                        </div>
	                        <!-- <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="company-column">Isi Disposisi</label>
	                                <input type="text" id="company-column" class="form-control" name="company-column" placeholder="-" readonly="" />
	                            </div>
	                        </div> -->
	                        <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="email-id-column">Perihal</label>
	                                <input type="text" id="email-id-column" class="form-control" name="perihal" placeholder="Perihal" value="{{$data['perihal']}}"/>
	                            </div>
	                        </div>

	                         <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="email-id-column">Jenis Surat</label>

									<select class="form-control" id="basicSelect" name="jenissurat">
											@foreach($js as $jenis)
													@if($data['jenis_surat'] == $jenis->id )
													 <option value="{{$jenis->id}}" selected="selected">{{$jenis->nama_jenis}}</option>
													@else
													@endif
                                            <option value="{{$jenis->id}}">{{$jenis->nama_jenis}}</option>
                                            @endforeach
                                            
                                    </select>
		                               
	                            </div>
	                        </div>

	                        <!-- <div class="col-md-6 col-12">
	                            <div class="form-group">
	                                <label for="email-id-column">Berkas Surat</label>
	                                <input type="file" id="filesuratmasuk" class="form-control" name="suratmasuk" placeholder="Email" />
	                            </div>
	                        </div> -->

	                        <!-- form dinamis -->
	                        <!-- <div class="col-md-6 col-12">
	                            <div class="form-group">
	                            	<label for="email-id-column">Upload Dokumen</label>
	                            	<span id="kotak"></span>	
	                            	<textarea id="name" class="name"></textarea>
	                            	<input type="file" id="filesuratmasuk" class="form-control" name="filesurat[]" id="name" required/>
									<button id="add" class="btn btn-md btn-primary">+</button>
	                                
	                            </div>
	                        </div> -->
	                        <!-- end form dinamis -->
	                        <div class="col-12">
	                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
	                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	<!-- </div> -->
</div>

<div class="row">
	  <div class="col-12">
	        <div class="card">
	        	<div class="card-header">
	                <h4 class="card-title">File Dokumen</h4>
	            </div>
	            <div class="card-body">
	            		<div class="row">
	                        <div class="col-md-12 col-12">
	                        	<table class="table table-striped table-hover responsive">	
	                        		<thead>
	                        			<tr>
	                        				<th>No</th>
	                        				<th>Nama File</th>
	                        				<th>Aksi</th>
	                        			</tr>
	                        		</thead>
	                        		<?php $i=1;?>
	                        		<tbody>	
	                        			@foreach($data->files as $file)
	                        			<tr>
	                        					<td>{{$i++}}</td>
	                        					<td>{{$file->file_original}}</td>
	                        					<td><button class="btn btn-relief-info" onClick="gantidokumen({{$file->id}})">Ganti File/Dokumen</button></td>
	                        			</tr>
	                        			@endforeach
	                        		</tbody>
	                        	</table>
	                        </div>
	                    </div>
	           	
	           	</div>
	        </div>

</div>

@endsection
@section('js')
    <script src="{{asset('themes/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{asset('themes/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <!-- END: Page JS-->
    <script type="text/javascript">
    	$(document).ready(function(){
    				

				$('#add').click(function(event){
					var tambahkotak = $('#kotak');
					event.preventDefault();	
					$('<div id="box"><input type="file" id="filesuratmasuk" class="form-control" name="filesurat[]" id="name" /><button id="remove" class="btn btn-sm btn-warning" style="">x</button></div>').appendTo(tambahkotak);
					// $('<div id="box"><textarea id="name" class="name"/></textarea><button id="remove">Hapus</button></div>').appendTo(tambahkotak);	
				});
				
				$('body').on('click','#remove',function(){	
					$(this).parent('div').remove();	
				});		
			});

    		function goBack() {
						  window.history.back();
						}
			function gantidokumen(id){
				var form = '';

				$('#filedokumen').modal('show');
				
			}
    </script>
@endsection