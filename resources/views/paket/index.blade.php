<?php use App\Http\Controllers\HelpersController as Helpers;

$haveaccessadd = Helpers::checkaccess('listPaket', 'add');
$haveaccessadd = Helpers::checkaccess('listPaket', 'delete');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">@endsection
{{-- <title>{{ $datas['title'] }}</title> --}}
{{-- {{ dd($datas) }} --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-box2-fill"></i>
            {{ __('List Paket') }} <?php if($haveaccessadd): ?> <button type="button" class="btn btn-success btn-sm" id="buttonaddPaket"> <i class="bi bi-box2-fill"></i> Add Paket</button><?php endif; ?>
        </h2>
    </x-slot>
                                                    {{-- HEADER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <table id="PaketTable"
                            class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                         
                                  <th>No</th>
                                    <th class="align-center">Paket</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="align-center">Paket</th>

                                        <th class="align-center">Action</th>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>                             
                                                                    <!-- MODAL VIEW -->
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modaladdTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-lg-start">
                    <h4><i class="icoon"></i></h4>
                    <h5 id="titledetailmodal" class="ms-2 modal-title"></h5>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="paketform">
                                @csrf
                                <dl class="row mb-0">
                                <dt class="col-sm-4">Paket</dt>
                                <dd class="col-sm-8">: <input type="text" name="nama" id="paketid" class="form-group paketid">
                                <div id="paket_lisy"></div>
                                <div class="modal-footer">
                                    <button id="closeModalmodaladd" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" id="save" class="btn btn-success btn-sm">Save</button>
                                </div>
                            </form>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>
          
    {{-- </div> --}}

   
    {{-- <div class="modal-dialog modal-lg modal_view">...</div>                                                     --}}
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script type="text/javascript">
            /////////////////////////////////////////////   GetData Table ///////////////////////////////////////////
            var url = "{{ asset('/api/paket/getdata') }}";
            function searcAjax(a, skip = 0) {
                if ($(a).val().length > global_length_src || skip == 1) {
                    var getparam = getAllClassAndVal("src_class_user"); // helpers
                    $('#PaketTable').DataTable().ajax.url(url + "?" + getparam).load();
                }else{
                    $('#PaketTable').DataTable().ajax.url(url).load();
                }
            }
            $(document).ready(function() {
                var getndate = getNowdate(); // helpers
                var table = $('#PaketTable').DataTable({
                    ajax: url,
                    columnDefs: [{
                            'targets': 2,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                return '<span class="btn btn-info btn-sm" onclick="showdetail(' + full[2] + ')">details</span>';
                            }
                        },

                        
                    ],

                });
            });

            $("#buttonaddPaket").on('click', function () { 
                $('#modaladd').modal('show');
                $("#titledetailmodal").html('Add Modal')
                $('.icoon').html('<i class="bi bi-plus-circle-fill"></i>');
                $("#paketid").val("");
                $('#paket_lisy').html("");

             })

             $('#paketid').keyup(function(){  
        var path = "{{ route('autocomplete') }}";
        var query = $(this).val();  
        //  $('.paketid').val();  
        if(query != '')  
        {  
                $.ajax({  
                    url: path,  
                    method:"GET",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        htmls1 = '<select class="list-unstyled form-control" name="selectproduct">';
                            // val = $('.paketid').val();  
                        $.each(data, function (k, i, j) { 
                            console.log(k,i.id);
                            htmls1 += "<option value=\""+i.id+"\">"+i.nama+"</option>";

                            // $('.paketid').val(i.nama);  
                           
                        });

                        htmls1 += '</select>  ';
                        $('#paket_lisy').html(htmls1);  
                        // $('#paket_lisy').html('<option value="">-- Select Provinsi --</option>')  
                               
                    }  
                });  
        }  
        if (query == '') {
            $('#paket_lisy').html('<select class="list-unstyled form-control"><option value="">-- Select option --</option></select>')  
        }
        else{
            $('#paket_lisy').html('<select class="list-unstyled form-control"><option value="">-- Select option --</option></select>')     
        }
    });  


              ///form submit pak heri nyerahhh 
    $(document).ready(function(){
        
        
        $( "#paketform" ).submit(function(e) {

            var url= "{{ asset('/paket/store') }}" ;


        e.preventDefault();
        var form = $('#paketform');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function (response) {
                        data = response.data;
                        if(data == 'success') {
                            Swal.fire({
                                title: 'Selamat!',
                                text: "Data Berhasil Disimpan",
                                icon: 'success'
                        
                            });
                            $('#modaladd').modal('hide');
                            reloaddata();
                        }
                        
                        
                        else {
                            $.each(response.errors, function(key, value){
                            Swal.fire({
                                title: 'Gagal!',
                                text: value,
                                icon: 'error'
                            });
                        });
                            
                        }

                 
                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });  
        });
      
            
                    /////////////////////////////////      Modal SHOW DETAIL       //////////////////////////////////////
            function showdetail(id) {
                $(".modal_view").modal('show');
            //     var addurl = $('#addvbtn').attr('data-attrref')+'/'+id;
            //   $('#addvbtn').attr('href', addurl);
            //     $('#saveee').attr('data-attid', id);
            //     var addurl = $('#deletevbtn').attr('data-attid', id);
            //     var url = "{{ asset('/division/detail') }}/" + id;
            //     var form = $('#modaladd');
            //     $('#undeletevbtn').html("Undelete");
            //         $.ajax({
            //             url: url,
            //             type: "GET",
            //             success: function(response) {
            //                 data = response.data;
            //                 if (data) {
            //                     $("#division_name").html(data.division_name);
            //                     if (data.active == 0) {
            //                         $("#activedetail").html("<span class='btn btn-secondary btn-sm'><b>Not Active</b></span>");
            //                     } else {
            //                         $("#activedetail").html("<span class='btn btn-success btn-sm'><b>Active</b></span>");
            //                     }
            //                     if (data.flag_delete == 0) {
            //                         $("#flagdelete").html("<span class='btn btn-primary btn-sm'><b>ON</b></span>");
            //                     } else {
            //                         $("#flagdelete").html("<span class='btn btn-danger btn-sm'><b>Delete</b></span>");
            //                     }

            //                     if (data.flag_delete == 0){
            //                         $('#deletevbtn').show();
            //                         $('#undeletevbtn').hide();
            //                     }
            //                     if (data.flag_delete == 1){
            //                         $('#deletevbtn').hide();
            //                         $('#undeletevbtn').show();
            //                     }
                               
            //                 }
            //                 reloaddata();
            //                 $('#viewUser').modal('show');
                  
            //             }
            //         }); 
            //     $('#deletevbtn').attr('data-attid', id);
            //     $('#editbtn').attr('data-attid', id);
            //     $('#editshow').attr('data-attid', id);
            //     $('#undeletevbtn').attr('data-attid', id);
            //     $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete Divisi');
            //     $("#titledetailmodal").html("Detail Division")
            }
                $("#closeModalmodaladd").click(function() {
                    $("#modaladd").modal('hide');
                });
                


              /////////////////////////////////      Modal DELETE       //////////////////////////////////////
            function deleteyesshow() {
                idx = $('#deletevbtn').attr('data-attid');
                test = '@csrf';
                token = $(test).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $('#viewUser');
                        var url = "{{ asset('/division/delete') }}/" + idx;
                        $.ajax({
                            url: url,
                            type: "get",
                            data: {
                                data: form.serialize(),
                                id: idx,
                                _token: token
                            },
                            cache: false,
                            success: function(response) {
                            
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $("#viewUser").modal('hide');
                       
                            reloaddata();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    }
                })
            }

            function undeleteyesshow(){
        $('#undeletevbtn').hide();
        idx = $('#undeletevbtn').attr('data-attid');
        test = '@csrf';
        token = $(test).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, undelete it!'
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                var url = "{{ asset('/division/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        id : idx,
                        _token: token,
                        undeleted : 1
                    },
                    success: function (response) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Undeleted',
                            html:'Your file has been <b>Undeleted</b>'
                        });
                        var url = "{{ asset('/api/divi/getdata') }}";
                        $("#viewUser").modal('hide');
                    
                        $('#PaketTable').DataTable().ajax.url(url).load();
                        $('#deletevbtn').show();
                        $("#activspan").html('Active');
                        $("#activspan").css('color', '#198754');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus, errorThrown);
                    }
                });
    
            } else {
                $('#undeletevbtn').show();
            }
        });
    }

    function reloaddata() {
        var url = "{{ asset('/api/paket/getdata') }}";
        $('#PaketTable').DataTable().ajax.url(url).load();
    }
        </script>
    @endsection
</x-app-layout>

