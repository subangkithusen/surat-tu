@extends('layouts.app2')

@section('konten')
<style type="text/css">
</style>
<div class="row">
	<!-- <div class="row"> -->

    <div class="col-lg-6 col-12">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>Surat yang akan di disposisikan </b><button  onclick="goBack()" class="btn btn-sm btn-primary">Kembali</button></h4>

                </div>
                <div class="card-body">
                    <form action="" method="post" class="form" enctype="multipart/form-data" id="fdispose">
                        {{csrf_field()}}
                        <input type="hidden" name="suratmasuk_id" value="{{$surat['id']}}">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first-name-column" class="badge badge-info">Surat Dari (RS-SATKER-PT) : {{$surat['dari']}}</label>

                                    </div>
                                     <div class="form-group">
                                        <label for="first-name-column" class="badge badge-info">Perihal : {{$surat['perihal']}}</label>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column" class="badge badge-info">Tanggal Surat : {{$surat['tanggal_surat']}}.</label>
                                       
                                    </div>

                                    <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><b>Isi Disposisi: </b></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Isi disposisi" name="isidisposisi"></textarea>
                                    </div>
                                    <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><b>Tanggapan: </b></label>
                                                <input type="text" name="tanggapan" class="form-control" name="tanggapan">
                                    </div>
                                   
                            </div>
                        </div>
                        

                </div>
        </div>
    </div>
	<!-- </div> -->
    <div class="col-lg-6 col-12">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                                    <label for="email-id-column"><b>Kepada</b></label>

                                    <select class="form-control" id="pegawai" name="kepada_pegawai[]" required multiple="multiple">
                                        @foreach($pegawai as $pg)
                                            <option value="{{$pg->id}}">{{$pg->nama}}</option>
                                        @endforeach                                                 
                                    </select>
                                       
                        </div>
                    </div>

                    <div class="col-md-12"> 
                    <label for="email-id-column"><b>Mohon</b></label> 
                    </div>


                    <div class="col-md-12">
                   @foreach($mohon as $m)
                    <div class="form-check form-check-inline" style="padding:3px;margin-right: 5px">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$m->id}}" name="mohon[]">
                        <label class="form-check-label" for="inlineCheckbox1">{{$m->namamohon}}</label>
                    </div>
                    @endforeach

                            
                    </div>

                    <div class="col-md-12">
                    <div class="form-group" style="margin-top:20px;">
                                    <button class="btn btn-md btn-success" id="dispose">Dispose</button>   
                    </div>
                    </div>
                    </form>
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

    <script src="{{asset('themes/app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('themes/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{asset('themes/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('themes/app-assets/js/scripts/forms/form-wizard.js')}}"></script>
    <script src="{{asset('themes/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <!-- END: Page JS-->
    <script type="text/javascript">
    	
    	$(document).ready(function() {
    		$('#pegawai').select2();
            //disposisi
            $('#dispose').click(function(e){
                e.preventDefault()
                var data = $('#fdispose').serialize()
                var url ='/disposisi';
               
                swal({
                        title: "Mohon di perhatikan",
                        text: "Apakah anda yakin untuk mendisposiskan surat ini?",
                        icon: "warning",
                        buttons: true,
                        successMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                             $.ajax({
                                url :  url,
                                data : data,
                                type :"POST",
                                success:function(response){
                                    console.log(response);
                                }
                            });
                            //statys true

                            swal("surat berhasil didisposisikan", {
                            icon: "success",
                            });
                        } else {
                            //status false
                            swal("surat tidak jadi didisposisikan");
                        }
                        });

                    })

		});
        function goBack() {
                          window.history.back();
                        }
    </script>
@endsection