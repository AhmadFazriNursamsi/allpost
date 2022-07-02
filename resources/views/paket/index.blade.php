<?php use App\Http\Controllers\HelpersController as Helpers;

$haveaccessadd = Helpers::checkaccess('listPaket', 'add');
$haveaccessadd = Helpers::checkaccess('listPaket', 'delete');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
@section('css')

@endsection
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
                                    <th class="align-center">Jabatan</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="align-center">Jabatan</th>

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
                                    <dt class="col-sm-4">nama</dt>
                                    <dd class="col-sm-8">: <input type="text" name="nama" class="form-group">
                                        <dt class="col-sm-4">Berat</dt>
                                        <dd class="col-sm-8">: 
                                            <div class="container">
                                                {{-- <h1>Laravel 8 Autocomplete Search using Bootstrap Typeahead JS - ItSolutionStuff.com</h1>    --}}
                                                <input class="typeahead form-control input" type="text" data-provide="typeahead">
                                                <br>
                                                <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Tulis Nama Provinsi Indonesia" />  
                                                <div id="provinsiList"></div>
                                            </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="closeModalmodaladd" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" id="save" class="btn btn-success btn-sm">Save</button>
                                </div>
                            </form>
            </div>
        </div>
    </div>
                                                                 
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

             })
             var path = "{{ route('autocomplete') }}";
    // $('input.typeahead').typeahead({
    //     source:  function (query, process) {
    //     return $.get(path, { query: query }, function (data) {
    //         return process(data);
    //         console.log(data);
    //         $.each(data, function (k, i) { 
    //             console.log(k,i.nama);
    //             return process(i.nama);
    //         })
    //         });
    //     }
    // });
    $('#provinsi').keyup(function(){  
        var query = $(this).val();  
        if(query != '')  
        {  
                $.ajax({  
                    url: path,  
                    method:"GET",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        htmls1 = '<select class="list-unstyled form-control">';
                        $.each(data, function (k, i) { 
                            console.log(k, i);
                            htmls1 += "<option value=\""+k+"\">"+i.nama+"</option>";
                        });
                        htmls1 += '</select>  ';
                        $('#provinsiList').size = data.length;
                        $('#provinsiList').html(htmls1);  
                    }  
                });  
        }  
    });  


              ///form submit
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
                            $('#paketform').hide();
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
                var addurl = $('#addvbtn').attr('data-attrref')+'/'+id;
              $('#addvbtn').attr('href', addurl);
                $('#saveee').attr('data-attid', id);
                var addurl = $('#deletevbtn').attr('data-attid', id);
                var url = "{{ asset('/division/detail') }}/" + id;
                var form = $('#modaladd');
                $('#undeletevbtn').html("Undelete");
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            data = response.data;
                            if (data) {
                                $("#division_name").html(data.division_name);
                                if (data.active == 0) {
                                    $("#activedetail").html("<span class='btn btn-secondary btn-sm'><b>Not Active</b></span>");
                                } else {
                                    $("#activedetail").html("<span class='btn btn-success btn-sm'><b>Active</b></span>");
                                }
                                if (data.flag_delete == 0) {
                                    $("#flagdelete").html("<span class='btn btn-primary btn-sm'><b>ON</b></span>");
                                } else {
                                    $("#flagdelete").html("<span class='btn btn-danger btn-sm'><b>Delete</b></span>");
                                }

                                if (data.flag_delete == 0){
                                    $('#deletevbtn').show();
                                    $('#undeletevbtn').hide();
                                }
                                if (data.flag_delete == 1){
                                    $('#deletevbtn').hide();
                                    $('#undeletevbtn').show();
                                }
                               
                            }
                            reloaddata();
                            $('#viewUser').modal('show');
                  
                        }
                    }); 
                $('#deletevbtn').attr('data-attid', id);
                $('#editbtn').attr('data-attid', id);
                $('#editshow').attr('data-attid', id);
                $('#undeletevbtn').attr('data-attid', id);
                $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete Divisi');
                $("#titledetailmodal").html("Detail Division")
            }
                $("#closeModalViewUser").click(function() {
                    $("#viewUser").modal('hide');
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
        $('#paketform').DataTable().ajax.url(url).load();
    }
        </script>
    @endsection
</x-app-layout>

