<?php use App\Http\Controllers\HelpersController as Helpers; 

$haveaccessadd = Helpers::checkaccess('users', 'add');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">


<style>
    .alll{
        height: 120px;
    }
    .btn-plus-alamat{
        border-radius: 32em;
    }
    .is-invalid {
    display: block;
}   
.alert-danger{
    line-height:0;
}
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-person-workspace"> </i>
            {{ __('Gudang') }} <button class="btn btn-success btn-sm" id="btn_addcustomer" onclick="addModal()"><i class="fa fa-plus"></i>Add Gudang</button> 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                   <div class="table-responsive">
                        <table id="gudangtable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    {{-- // nama	divisi aliasgudang product user active active	 --}}
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="nama" name="nama"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="alamat" name="alamat"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Alias Gudang" name="alias_gudang"></td>
                                   
                                    <td>
                                        <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Status Active --</option>
                                          <option value="1">Active</option>
                                          <option value="0">Not Active</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" class="checkall" name="checkall"></th>
                                    <th class="align-center">Nama Gudang</th>
                         
                                    <th class="align-center">Alamat </th>
                                      <th class="align-center">Alias_gudang</th>
                            

                                    <th class="align-center">Active</th>
                                    <th class="align-center">Status delete</th>
                                    <th class="align-center">Action</th>
                                    
                                </tr>
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">Nama Gudang</th>
                         
                                    <th class="align-center">Alamat </th>
                                      <th class="align-center">Alias_gudang</th>
                            

                                    <th class="align-center">Active</th>
                                    <th class="align-center">Status Delete</th>
                                    <th class="align-center">Action</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Add modal -->
<div class="modal fade" id="addmodall" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

        <div class="row">
            <div class="container">
                <div class="modal-header lg">
                    <div class="justify-content-lg-start">
                        <h4><i id="iconn" ></i><i class="icoon ms-2"><span id="icon"></span><span id="titleaddmodal" class="icoon" class="ms-2"></span></i></h4>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="col">
                        <form id="formm">
                            @csrf
                            <div class="form-group">
                                
                                <label for="name" class="form-label nama">Nama Gudang</label>
                                
                                <input type="text" class="form-control nama " placeholder="Nama" name="nama" id="nama" aria-describedby="validationServer03Feedback">
                           
                                </div> 
                            </div>
                            
                        </div>
                <div class="mb-3">
                    <div class="col">
                        <label for="alias_gudang" class="form-label alias_gudang">alias_gudang</label>
                        <input type="alias_gudang" class="form-control alias_gudang" placeholder="alias_gudang" name="alias_gudang" id="alias_gudang" aria-describedby="validationServer03Feedback" >

                  
                    </div> 
                </div>

                <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control alll alamat" name="alamat" placeholder="Alamat" id="alamat"></textarea>
                      </div>

                      <div class="col-3">
                        <select name="user" class="form-control user" id="id_user" onchange="Userchange(this)">
                            {{-- {{ dd($datas) }} --}}
                            <option value="" required>-- Select Provinsi --</option>
                            <?php foreach ($datas['user'] as $key => $post) :?>
                            <option id="userid" value="{{ $post->id }}">{{ $post->name }}</option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                    
                    <div class="d-flex justify-content-end">
                        <div class="control-group after-add-more">
                            {{-- <button type="button" class="remove btn-danger">hapus</button> --}}
                        
                            <div class="copy control-group"><span id="changeuserselect" class="ms-2"></span></div>
                        </div>
                        
                        {{-- <div class="copy hide control-group"><span id="changeuserselect" class="ms-2"></span></div> --}}
                    </div>
                    {{-- <div class="control-group">

                        <button type="button" class="btn-danger remove">hapus</button>
                    </div> --}}
                    
                <div class="mb-3">
                    <div class="col">
                        <label for="active" class="form-label active_class">Status Active</label>
                        <div class="form-check">
                            <input required class="form-check-input  active_class" type="radio" value="1" name="active" id="active">
                            <label class="form-check-label active_class" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input required class="form-check-input active_class" type="radio" value="0" name="active" id="active2">
                            <label class="form-check-label active_class" for="active2">
                                Not Active
                            </label>
                        </div>
                        
                    </div>
                </div>

                <div class="tab-content d-flex justify-content-end" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <dl class="row mb-0" id="datauser-1"></dl>
            </div>
            <div class="tab-pane fade btn-add-cencel" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
               
            </div>

        </div>
    </div>

    <div class="modal-footer">
      <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button id="save" type="submit" class="btn btn-success btn-sm" data-dismiss="modal">Save</button>
    </form>
    </div>
    </div>
    </div>
  </div>
</div>




{{-- View Modal --}}
<div class="modal fade" id="viewCustomer" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="container">
                    <div class="modal-header lg">
                        <div class="justify-content-lg-start">
                            <h4><i class="bi bi-clipboard2-minus"><span id="titledetailmodal"></span></i></h4>
                        </div>
                 
                            <div class="d-flex justify-content-end">
                                <ul class="nav nav-pills mb-3" id="pills-tab mt-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link headder" id="pills-home-tab" onclick="mainshowalamata()" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" >Main Info</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link " id="pills-profile-tab" onclick="alamatview()" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Alamat</button>
                                    </li>
                                </ul>
                            </div>   
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 show_name">Nama </dt>
                                <dd class="col-sm-8 show_name">: <span name="name" id="show_name"></dd>
                                        
                            <dt class="alias_gudang col-sm-4">Alias Gudang </dt>
                                <dd class="alias_gudang col-sm-8">: <span name="email" id="alias_gudang_view"></dd>



                            <dt class="show_tlp col-sm-4">Alamat</dt>
                                <dd class="show_tlp col-sm-8">: <span name="no_tlp" id="show_alamat"></dd>

                                        
                            <dt class="show_status col-sm-4">Status</dt>
                                <dd class="show_status col-sm-8">: <span id="activedetail"></span>
                            <dt class="show_delete col-sm-4">Status Delete</dt>
                                <dd class="show_delete col-sm-4">: <span id="flagdelete"></span></dd>
                        </dl>

                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                @if ($haveaccessadd) 
                <button class="btn-success btn-sm" data-attid="" onclick="editshow()" id="editbtn"><i class="fa fa-edit"></i> Edit Customers</button>
              @endif
                @if ($haveaccessdelete)
                    <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                        <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-warning btn-sm"></button>
                @endif
            </div>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">
    var url = "{{ asset('/api/gudang/getdata') }}";
    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#gudangtable').DataTable().ajax.url(url+"?"+getparam).load();
        }
        else {
          $('#gudangtable').DataTable().ajax.url(url).load();
        }
    }

    $(document).ready(function(){
        var getndate = getNowdate(); // helpers
        $("#daterangepicker").val(getndate + ' - ' + getndate );
        $(".datepicker").val(getndate);
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });

        $("#daterangepicker").daterangepicker({
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });


        var table = $('#gudangtable').DataTable({
            ajax: url,
            columnDefs: [
                 {
                   'targets': 6,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                    //    console.log(full[6]);
                       return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[6]+')">details</span>';
                   }
                }, {
                   'targets': 0,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<input type="checkbox" class="ckc" name="checkid['+full[8]+']" value="' + $('<div/>').text(data).html() + '">';
                   }
                }, {
                   'targets': 4,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       
                    //    console.log(full[4]);
                        if(full[4] != 0)
                        return '<span class="btn btn-success btn-sm">Active</span>';
                        else 
                        return '<span class="btn btn-secondary btn-sm">Not Active</span>';
                   }
                },
                {
                   'targets': 5,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                        if(full[5] == 0)
                        return '<span class="btn btn-primary btn-sm">ON</span>';
                        else 
                        return '<span class="btn btn-danger btn-sm">Deleted</span>';
                   }
                }
            ],
            searching: false,
        }); 


       
        $('.checkall').change(function(){
            var cells = table.cells().nodes();
            $( cells ).find('.ckc:checkbox').prop('checked', $(this).is(':checked'));
        });

        appendDivisionOption();
        appendUsersOption();
        appendRoleOption();
        

    });



    ////////////////////////////// Add Modal
    function addModal(){
        
        $("#addmodall").modal('show');
        $("#icon").html("<i class='bi bi-person-workspace'>  </i>");
        $("#titleaddmodal").html("Add Gudang");
        $("#addvbtn").hide();
        $("#deletevbtn").hide();
        $("#undeletevbtn").hide();
    }   


    ///form submit
    $(document).ready(function(){
        
        $( "#formm" ).submit(function(e) {
        var url= "{{ asset('/gudang/store') }}" ;
        idx = $('#editbtn').attr('data-attid');
        if(idx != "")
        var url = "{{ asset('/customers/update') }}/" + idx ;


        e.preventDefault();
        var form = $('#formm');
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
                            $("#name").val();
                            $("#email").val();
                            $("#no_tlp").val();

                            $(".provinsi").val();
                            $(".kabupaten").val();
                            $(".kecamatan").val();
                            $(".kelurahan").val();
                            $(".alamat").val();
                            
                            $(".provinsi").show("");
                            $(".kabupaten").show("");
                            $(".kecamatan").show("");
                            $(".kelurahan").show("");
                            $(".alamat").show("");

                            $(".email").show("");
                            $(".no_tlp").show("");
                            $(".active_class").show("");
                            $(".nama").show("");
                            $("#addmodall").modal('hide');
                            $("#formm")[0].reset();
                            reloaddata();
                            $('.alert-danger').hide();
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

function Userchange(a){
        iddalamat = $(a).val();
        var url = "{{ asset('/api/changeuser') }}/" + iddalamat;
        var html = $(".copy").html();
       $.ajax({
          url : url,
          type: 'get',
          success: function (response) {
              console.log(response.data[0].name);
            //   $("#changeuserselect").show()\
            // $.each( response.data[0], function(k, v) {
                // console.log(k.name);
                $(".after-add-more").after(html);
              
                            //     <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                             
                            //   </div>
                                $('.copy').after(" <div class='alert alert-success alert-dismissible fade show' role='alert'><b><strong>"+response.data[0].name+"</strong></b>   <button type='button' class='btn-close col-1 lg' data-bs-dismiss='alert' aria-label='Close'></button>");

                // $('.copy').after("<span class='btn btn-success btn-sm'><b>"+response.data[0].name+"</b></span>");
              
                    // })
            //   $.each( result.data, function(k, v) {
                //     if(id_kab != 0) {  
              
            //         if(id_kab == k) {
      
            //             $('#kabupaten_id').append($('<option>', {value:k, text:v}));
            //             $("#kabupaten_id option[value='"+k+"']").attr("selected", "selected");                        
            //         } else 
            //             $('#kabupaten_id').append($('<option>', {value:k, text:v}));
            //     } 
            //     else 
            //         $('#kabupaten_id').append($('<option>', {value:k, text:v}));
            //    });
          },
          
          error: function(jqXHR, textStatus, errorThrown) {
            alert('something wrong');
            console.log(textStatus, errorThrown);
        }
        

       });

}
// $(document).ready(function() {
//       $(".add-more").click(function(){ 
//           var html = $(".copy").html();
//           $(".after-add-more").after(html);
          
//       });
//     })



    function showdetail(id) {
        var addurl = $('#addvbtn').attr('data-attrref')+'/'+id;
            $('#addvbtn').attr('href', addurl);
            $('#saveee').attr('data-attid', id);
   
        var addurl = $('#deletevbtn').attr('data-attid', id);
        var url = "{{ asset('/gudang/detail') }}/" + id;
        var form = $('#viewCustomer');
            $('#undeletevbtn').html("Undelete");
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        data = response.data;
  
                        if (data) {
                            // console.log(data[0].nama);
                            data = data[0]
                            $("#show_name").html(data.nama);
                            $("#alias_gudang_view").html(data.alias_gudang);
                            $("#show_alamat").html(data.alamat);
 
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
                                $('#viewCustomer').modal('show'); 
                    }
                }); 
            $('#deletevbtn').attr('data-attid', id);
            $('#editbtn').attr('data-attid', id);
            $('#undeletevbtn').attr('data-attid', id);
            $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete Divisi');
            $("#titledetailmodal").html("Detail Customer")
    }
            $("#closeModalViewUser").click(function() {
                $("#viewCustomer").modal('hide');
                $("#addmodall").modal('hide');
            });

    function alamatview(){
        $(".show_name").hide();
        $(".alias_gudang_view").hide();
        $(".show_tlp").hide();
        $(".show_status").hide();
        $(".show_delete").hide();
        
        $(".show_province").show();
        $(".show_kabupaten").show();
        $(".show_kecamatan").show();
        $(".show_kelurahan").show();
        $(".show_alamat").show();
        
        $(".show_province").val();
        $(".show_kabupaten").val();
        $(".show_kecamatan").val();
        $(".show_kelurahan").val();
        $(".show_alamat").val();
    }

   

    function editshow(){
        idx = $('#editbtn').attr('data-attid',);
        // <i class="bi bi-person-workspace"> </i>
        $("#iconn").html("<i class='bi bi-person-workspace'> </i>");
        $(".icoon").html("Edit Customers");
     
        var url = "{{ asset('/gudang/edit') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "GET",
                        success: function(response) {
                            data = response.data;
                            if(data) {
                          
                                $("#nama").val(data[0].nama);
                                $("#alias_gudang").val(data[0].alias_gudang);
                                $(".alamat").val(data[0].alamat);
                                // $("#no_tlp").val(data.no_tlp);
                                if(data[0].active != 0){
                                    $("#active").attr('checked', 'checked');
                                }
                                else {
                                    $("#active2").attr('checked', 'checked');
                                        }
                            }
                  
                                $("#closemodaledit").modal('hide');
                                $('#addmodall').modal('show');
                                $('#viewCustomer').modal('hide');
                                
                            }
                        
                });
    }
    

    function appendDivisionOption(){
        // add division
        var url = "{{ asset('/api/getdivision') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#divisi').append($('<option>', { 
                      value: item.id_division,
                      text : item.division_name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }
    function appendUsersOption(){
        // add division
        var url = "{{ asset('/api/getUser') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#users_id').append($('<option>', { 
                      value: item.id,
                      text : item.name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function appendRoleOption(){
        var url = "{{ asset('/api/getrole') }}";
            $.ajax({
                url: url,
                type: "get",
                success: function (response) {
                    $.each(response.data, function (i, item) {
                        $('#role').append($('<option>', { 
                            value: item.id_role,
                            text : item.role_name 
                        }));
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
    }

    function deleteyesshow(){
        $('#deletevbtn').hide();
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
                var url = "{{ asset('/gudang/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        id : idx,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            html:'Your file has been <b>Deleted</b>'
                        });
                        reloaddata();
                        $("#viewCustomer").modal("hide");
                        $("#activspan").html('deleted');
                        $("#activspan").css('color', '#dc3545');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('something wrong');
                        console.log(textStatus, errorThrown);
                    }
                });

            } else {
                $('#deletevbtn').show();
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
        }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ asset('/gudang/delete') }}/" + idx;
                    $.ajax({
                        url: url,
                        type: "get",
                        data: {
                            id : idx,
                            _token: token,
                            undeleted : 1
                        },
                        success: function (response) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Undeleted',
                            html:'Your file has been <b>Undeleted</b>'
                            });
                            reloaddata();
                            $("#viewCustomer").modal("hide");
                            $("#activspan").html('-');
                            $("#activspan").css('color', '#198754');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });

                } else {
                $('#undeletevbtn').show();
                }
        })
    }

    function reloaddata() {
                $('#gudangtable').DataTable().ajax.url(url).load();
            }

    
</script>
@endsection    
</x-app-layout>



