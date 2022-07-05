<?php use App\Http\Controllers\HelpersController as Helpers;

$haveaccessadd = Helpers::checkaccess('listPaket', 'add');
$haveaccessadd = Helpers::checkaccess('listPaket', 'delete');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

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
                                  <th class="align-center">Nama Paket</th>
                                    <th class="align-center">Paket</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="align-center">Nama Paket</th>
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
                                                                    <!-- MODAL add -->
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
                                <dt class="col-sm-4">Nama Paket</dt>
                                <dd class="col-sm-8">: <input type="text" name="nama_paket" id="nama_paket" class="form-group nama_paket">
                                <dt class="col-sm-4"></dt>
                                <dd class="col-sm-8">: <input type="text" name="nama" id="paketid" class="form-group paketid"><button type="button" class="btn-primary"><i class="bi bi-search"></i></button>
                                <div id="paket_lisy"></div>
                                <input type="hidden" name="user_group" id="user_group">
                                <div class="d-flex justify-content-end">
                                    <div class="control-group after-add-more">
                                    
                                        <div class="copy control-group"></div>
                                    </div>
                                </div></dd>
                                </dl>
                              
                                <table id="listgudangtable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            {{-- <th class="align-center">Gambar</th> --}}
                                            <th class="align-center">Nama Product</th>
                                            <th class="align-center">Satuan</th>
                                            <th class="align-center">Alias</th>
                                            <th class="align-center">Jumlah</th>
                       
                                            
                                        </tr>
                                        
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th class="align-center">Nama Product</th>
                                            <th class="align-center">Satuan</th>
                                              {{-- <th class="align-center">Gambar</th> --}}
                                              <th class="align-center">Alias</th>
                                              <th class="align-center">Jumlah</th>
                         
                                        
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                                                           
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

                                                                    <!-- MODAL VIEW -->
    <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="modaladdTitle" aria-hidden="true">
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
                            'targets': 3,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                return '<span class="btn btn-info btn-sm" onclick="showdetail(' + full[3] + ')">details</span>';
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
                $('#user_group').hide();
                $('.copy').html("");
                $(".control-group after-add-more").html("");

             })

            //  function search() { 

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
                        htmls1 = '<select class="list-unstyled form-control form-group col-sm-8" id="id_user" name="selectproduct" onchange="table(this)">';
                            // val = $('.paketid').val();  
                            $.each(data, function (k, i, j) { 
                            console.log(k,i.id);
                            // htmls1 +='<option value="">-- Select option --</option></select>';
                            htmls1 += "<option value=\""+i.id+"\">"+i.nama+"</option>";
                            
                            // $('.paketid').val(i.nama);  
                            
                        });
                        htmls1 += '<option value="" selected>-- Select option --</option></select>';
                        // $('#paket_lisy').html('<select class="list-unstyled form-control"><option value="">-- Select option --</option></select>')  
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

// }
    
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

                        $('#user_group').hide();
                        $('.copy').html("");
                        $(".after-add-more").html("");
                 
                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });  
        });
      
            
                    /////////////////////////////////      Modal SHOW DETAIL       //////////////////////////////////////
            function showdetail(id) {
                $("#modal_view").modal('show');
                $("#modaladd").modal('hide');

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
            function paketchange(a) { 
                id = $(a).val();
        var hidden = $("#user_group").val();
        var tampung = hidden + ', ' + id;
        nama = $( "#id_user option:selected" ).text();
        const pattern = new RegExp('(' + id + ')', 'gm');
        let m;
        if(m = pattern.exec(hidden) == null) {
            var html = $(".copy").html();
            $("#user_group").val(tampung);
            // console.log(nama,id);
            $('.copy').after("<div class='alert alert-success alert-dismissible fade show' role='alert'><b><span class='mx-2 btn btn-info' onclick='showdetail()'><i class='bi bi-eye-fill'></i></span><strong>"+nama+"</strong></b><button type='button' class='btn-close col-1 lg' id='close-"+id+"' data-bs-dismiss='alert' aria-label='Close' onClick=\"kurangininput("+id+")\"></button>");
        }
             }

    function table(a) { 
        id = $(a).val();
        var hidden = $("#user_group").val();
        var tampung = hidden + ', ' + id;
        nama = $( "#id_user option:selected" ).text();
        const pattern = new RegExp('(' + id + ')', 'gm');
        let m;

        if(m = pattern.exec(hidden) == null) {
            $("#user_group").val(tampung);}
        $("#viewCustomer").modal("hide");
        $("#titlelistmodal").html(" List Product");
        $("#ListModal").modal("show");
        var url = "{{ asset('/api/tableproduct/getdata') }}/" + id;
        // $('#gudangtable').DataTable();
        $('#listgudangtable').DataTable().ajax.url(url).load();
    }
    $(document).ready(function() {
        // var url = "{{ asset('/api/tableproduct/getdata') }}";
                var getndate = getNowdate(); // helpers
                var table = $('#listgudangtable').DataTable({
                    // ajax: url,
                    columnDefs: [
                        {
                            'targets': 4,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                return ' <input type="number" name="jumlah" id="jumlah" class="form-group jumlah">';
                            }
                        },

                        
                    ],

                });
            });
             

             function kurangininput(a) { 
    var tampung = $("#user_group").val();
    tampung = tampung.replace(", "+a, "");
    $("#user_group").val(tampung);
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

