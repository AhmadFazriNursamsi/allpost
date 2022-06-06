<?php use App\Http\Controllers\HelpersController as Helpers; 

    $haveaccessadd = Helpers::checkaccess('divisions', 'add');
    $haveaccessadd = Helpers::checkaccess('divisions', 'delete');
    $haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<title>{{ $title }}</title>

<x-app-layout>


<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-clipboard-fill"></i>
{{ __('Divisions') }} <?php if($haveaccessadd): ?> <button class="btn btn-success btn-sm" id="btnmodaladd" onclick="BtnAddModal()">Add Divisions</button> <?php endif; ?>
</h2>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="table-responsive">
                    <table id="divisionTable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
        <thead>
            <tr>
                <td></td>
  <td>
                                        <select name="division" id="division" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Division --</option>
                                        </select>
                                    </td>
                                    <td>
                    <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                      <option value="">-- Status Active --</option>
                      <option value="1">Active</option>
                      <option value="0">Not Active</option>
                    </select>
                </td>
                {{-- <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="email" name="email"></td> --}}
                <td>
                </tr>
                <th><input type="checkbox" class="checkall" name="checkall"></th>
                <th class="align-center">Jabatan</th>
                <th class="align-center">Active</th>
                <th class="align-center">Action</th>
            </tr>
        </thead>
    <tfoot>
            <tr>
                <th></th>
                <th class="align-center">Jabatan</th>
                <th class="align-center">Active</th>
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
<form id="addpostmodal">
    @csrf
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start ">
                <i class="bi bi-clipboard-fill modal-title"></i><h5 id="titleaddmodal" class="ms-2 modal-title"></h5>
                    <div class="alert alert-danger" style="display:none"></div>
                </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="division_name" class="form-label">Jabatan</label>
                                <input type="text" class="form-control @error('division_name') is-invalid @enderror" placeholder="Jabatan" name="division_name" id="division_name1" aria-describedby="validationServer03Feedback">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                Please provide a valid city.
                                </div>
                        </div> 
                        </div>
                    <div class="mb-3">
                        <div class="col-md-6">
                        <label for="active" class="form-label">Status Active</label>
                        <br> <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="active" id="active" checked>
                            <label class="form-check-label" for="active">
                            Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="active" id="active">
                            <label class="form-check-label" for="active">
                            Not Active
                            </label>
                        </div>
                        {{-- <input type="radio" value="1" name="active" id="active"> Active
                        <input type="radio" value="0" name="active"> Not-Active --}}
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" data-attid="" data-deleteval="1" id="saveee" class="btn btn-success">Save</a>
                        </div>
            </div>
        </div>
    </div>
    </div>
</form>

<!-- view modal -->

<div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-lg-start">
                <h4><i class="bi bi-pencil-square"></i></h4><h5 id="titledetailmodal" class="ms-2 modal-title"></h5>
            </div>
                <div class="modal-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                   <dl class="row mb-0">
                                            <dt class="col-sm-4">Jabatan</dt>
                                            <dd class="col-sm-8">: <span name="division_name" id="division_name"></dd>
                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8">: <span class="btn btn-success btn-sm" id="active2"></span>
                                        </dl>
                                    </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            not available
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            not available         
                                        </div>
                                </div>
                                </div>
                    <div class="modal-footer">
                        <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        @if ($haveaccessadd)
                        <button onClick="editmodaldevisi()" data-attid="" data-deleteval="1" id="editbtn" class="btn btn-success btn-sm">Edit</a>
                        @endif
                        @if ($haveaccessdelete) :
                            <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                 
                        @endif
                    </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-lg-start">
                <h4><i class="bi bi-pencil-square"></i></h4><h5 id="titledetailmodal" class="ms-2 modal-title"></h5>
            </div>
                <div class="modal-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                   <dl class="row mb-0">
                                            <dt class="col-sm-4">Jabatan</dt>
                                            <dd class="col-sm-8">: <input name="division_name" id="division_name_edit"></dd>
                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8">: <span class="btn btn-success btn-sm" id="active_"></span>
                                        </dl>
                                    </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            not available
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            not available         
                                        </div>
                                </div>
                                </div>
                    <div class="modal-footer">
                        <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        @if ($haveaccessadd) :
                        <button onclick="editmodaldevisi()"><i class="fa fa-edit"></i> Edit User</a></button>
                        @endif
                        @if ($haveaccessdelete) :
                    
                            <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                 
                        @endif
                    </div>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">

// GetData Table
var url = "{{ asset('/api/divi/getdata') }}";
    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
             var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#divisionTable').DataTable().ajax.url(url+"?"+getparam).load();
        }
    }
$(document).ready(function(){
    var getndate = getNowdate(); // helpers
    var table = $('#divisionTable').DataTable({
        ajax: url,
        columnDefs: [
            {
                'targets': 3,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    // return '<a href="{{URL::to('/division/detail/{id_}')}}" data-attrref="{{URL::to('/division/detail/{division_name}')}}" onclick="showdetail('+full[3]+')" id="addvbtn" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit User</a>'
                    return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[3]+')">details</span>';
                }
            },
            {
                'targets': 0,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox"  class="ckc" name="checkid['+full[0]+']" value="' + $('<div/>').text(data).html() + '">';
                }
            }, 
            {
                'targets': 2,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    if(full[2] == 0)
                    return '<span class="btn btn-danger btn-sm">not active</span>';
                    else 
                    return '<span class="btn btn-success btn-sm">active</span>';
                }
            }
        ],
        searching: false,
    }); 
    $("#closeModalViewUser").click(function(){
        $("#viewUser").modal('hide');
    });
        appendDivisionOption();
        appendRoleOption();
});


function BtnAddModal(){
    $('#addmodal').modal('show')
    $("#titleaddmodal").html("Add Divisions")
}
$(document).ready(function(){
    
    idx = $('#saveee').attr('data-attid');
    test = '@csrf';
        token = $(test).val();
        
        $('#addpostmodal').submit(function(e){
            
            var url = "{{ asset('/division/store') }}/" + idx;
            test = '@csrf';
        token = $(test).val();
        e.preventDefault();
        var form = $('#addpostmodal');
    
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data){
                    reloaddata();
                    Swal.fire({
                        title: 'Data Berhasil Disimpan!',
                        icon: 'success',
                        confirmButtonColor: 'green',
                        
                    })
                    $("#addmodal").modal('hide');
                    $("#addpostmodal")[0].reset();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    
                }
                
            });
            
        });  
    });


function showdetail(event){
    var id  = event
    // console.log(event);
    var addurl = $('#deletevbtn').attr('data-attid', id); 
    var url = "{{ asset('/division/detail') }}/"+id;
    var form = $('#viewUser');
        
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                data = response.data;
          if(data) {
              $("#division_name").html(data.division_name);
              $("#active2").html(data.active);
            // $("#description").val(response.description);
            // $('#post-modal').modal('show');
          }
          $('#viewUser').modal('show');
      }
      
    });
        // $('#addvbtn').attr('href', addurl);
        $('#deletevbtn').attr('data-attid',id, idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete User');
        $("#titledetailmodal").html("Detail Division")
        
}

function editmodaldevisi(){
    idx = $('#deletevbtn').attr('data-attid');
    var url = "{{ asset('/division/update') }}/" + idx;
    var form = $('#viewmodal');
    // $("#editbtn").html("Edit Devisi");
        
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                data = response.data;
          if(data) {
              $("#division_name").val(data.division_name_edit);
              $("#active2").html(data.active_edit);
            // $("#description").val(response.description);
            // $('#post-modal').modal('show');
          }
          $('#editmodal').modal('show');
      }
      
    });
        // $('#addvbtn').attr('href', addurl);
        $('#deletevbtn').attr('data-attid',id, idx);
        $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete User');
        $("#titledetailmodal").html("Detail Division")
        
}

function appendDivisionOption(){
// add division
var url = "{{ asset('/api/getdivision') }}";
$.ajax({
url: url,
type: "get",
success: function (response) {
$.each(response.data, function (i, item) {
$('#division').append($('<option>', { 
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

function appendRoleOption(){
// add division
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
                        id : idx,
                        _token: token
                    },
                    success: function (response) {
                        reloaddata();
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    $("#viewUser").modal('hide');
                    $("#addpostmodal")[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
      })
}
  

function reloaddata(){
$('#divisionTable').DataTable().ajax.url(url).load();
}


</script>

@endsection    
</x-app-layout>


