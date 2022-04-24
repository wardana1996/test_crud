<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">selamat datang, {{Auth::user()->name}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">Admin One To One</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin_to_many.index') }}">Admin One To Many</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin_many_to_many.index') }}">Admin Many To Many</a>
                </li>
            </ul>
            <form class="d-flex" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-success" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Create</button>
            <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCreate" method="POST">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="insert name...">
                                        <span class="text-danger small" id="nameerror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control form-control-sm" id="email" placeholder="insert email...">
                                        <span class="text-danger small" id="emailerror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Address</label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" name="address" class="form-control form-control-sm" id="address" placeholder="insert address..."></textarea>
                                        <span class="text-danger small" id="addresserror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="phone_number" class="form-control form-control-sm" id="phone_number" placeholder="insert phone number...">
                                        <span class="text-danger small" id="phonenumbererror"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row col-2 ml-1">
                <select class="form-select " id="searchRole" aria-label="Default select example" required>
                    <option value="" hidden>-- choose role --</option>
                    <option value="member employee">Member Employee</option>
                    <option value="member admin">Member Admin</option>
                </select>
            </div>
            <br>
            <div class="table-responsive">
                <table class="display" id="adminTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formUpdate" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control form-control-sm" id="name_edit" required>
                                    <span class="text-danger small" id="nameerrorupdate"></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control form-control-sm" id="email_edit" required>
                                    <span class="text-danger small" id="emailerrorupdate"></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Address</label>
                                <div class="col-sm-8">
                                    <textarea rows="5" name="address" class="form-control form-control-sm" id="address_edit" required></textarea>
                                    <span class="text-danger small" id="addresserrorupdate"></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
                                <div class="col-sm-8">
                                    <input type="number" name="phone_number" class="form-control form-control-sm" id="phone_number_edit" required>
                                    <span class="text-danger small" id="phonenumbererrorupdate"></span>
                                 </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="buttonUpdate" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var table = $('#adminTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength : 6,
                lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
                ajax: {
                    url: "{{ route('admin.index') }}",
                    type: 'GET',
                    data: function (d) {
                        d.role = $('#searchRole').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                    { data: 'memberToMember', name: 'memberToMember.name' },
                    { data: 'role', name: 'role' },
                    { data: 'memberToMemberEmail', name: 'memberToMember.email' },
                    { data: 'memberToMemberAddress', name: 'memberToMember.address' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[0, 'desc']]
            });

            $("#searchRole").change(function(){
                table.draw();
            });

            $(document).on('submit', '#formCreate', function(event){  
                event.preventDefault();  
                var name = $('#name').val();    
                var email = $('#email').val();   
                var address = $('#address').val(); 
                var phone_number = $('#phone_number').val(); 
                $.ajax({
                    url: "{{ route('admin.create') }}",
                    cache: false,  
                    method:'POST',  
                    data:  $(this).serialize(),
                    success: function(data){
                        Swal.fire({
                            title: 'submit success',
                            text: "sukses",
                            icon: 'success',
                            confirmButtonColor: '#004028',
                            confirmButtonText: 'Yes',
                            allowOutsideClick: false
                        });
                        $('#formCreate')[0].reset(); 
                        $('#modalCreate').modal('hide');  
                        $('#adminTable').DataTable().ajax.reload( null, false ); 
                    },
                    error:function (response) {
                        $("#nameerror").hide().text(response.responseJSON.errors.name).fadeIn('slow').delay(2000).hide(1);
                        $("#emailerror").hide().text(response.responseJSON.errors.email).fadeIn('slow').delay(2000).hide(1);
                        $("#addresserror").hide().text(response.responseJSON.errors.address).fadeIn('slow').delay(2000).hide(1);
                        $("#phonenumbererror").hide().text(response.responseJSON.errors.phone_number).fadeIn('slow').delay(2000).hide(1);
                    }
                })
            });

            $(document).on("click", ".editPhone", function () {
                var id = $(this).data('id');
                $.ajax({
                    type:"POST",
                    url: "{{ url('/admin/edit') }}"+'/'+id,
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        $('#modalEdit').modal('show');
                        $('#id').val(res.id);
                        $('#name_edit').val(res['member_to_member'].name);
                        $('#email_edit').val(res['member_to_member'].email);
                        $('#address_edit').val(res['member_to_member'].address);
                        $('#phone_number_edit').val(res.phone_number);
                    }
                });
            });

            $(document).on('click', '#buttonUpdate', function(event){  
                event.preventDefault(); 
                var name = $('#name_edit').val();
                var email = $('#email_edit').val();  
                var address = $('#address_edit').val(); 
                var phone_number = $('#phone_number_edit').val();  
                var id = $('#id').val();  
                $.ajax({
                    url: "{{ url('/admin/update') }}"+'/'+id,
                    cache: false,
                    method:"POST",
                    data: $('#formUpdate').serialize(),
                    success: function(data){
                        Swal.fire({
                            title: 'data berhasil diupdate',
                            text: "sukses",
                            icon: 'success',
                            confirmButtonColor: '#004028',
                            confirmButtonText: 'Oke',
                            allowOutsideClick: false
                        });
                        $('#formUpdate')[0].reset(); 
                        $('#modalEdit').modal('hide');
                        $('#adminTable').DataTable().ajax.reload( null, false );      
                    },
                    error:function (response) {
                        $("#nameerrorupdate").hide().text(response.responseJSON.errors.name).fadeIn('slow').delay(2000).hide(1);
                        $("#emailerrorupdate").hide().text(response.responseJSON.errors.email).fadeIn('slow').delay(2000).hide(1);
                        $("#addresserrorupdate").hide().text(response.responseJSON.errors.address).fadeIn('slow').delay(2000).hide(1);
                        $("#phonenumbererrorupdate").hide().text(response.responseJSON.errors.phone_number).fadeIn('slow').delay(2000).hide(1);
                    }
                })
            });  
            
            $(document).on('click', '.delete', function(){  
                var id = $(this).attr("data-id");  
                Swal.fire({
                    title: 'Apakah anda yakin untuk menghapus data ini ?',
                    text: "data akan dihapus secara permanen !",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#004028',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('/admin/delete') }}"+'/'+id,
                            cache: false,
                            method:"DELETE",  
                            data: { id: id },
                            success: function(data){
                                $('#adminTable').DataTable().ajax.reload( null, false );       
                            },
                            error: function(){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Maaf...',
                                    text: 'Ada Kesalahan !',
                                })
                            }
                        }),
                        Swal.fire({
                            title: 'Terhapus',
                            text: "Data berhasil dihapus",
                            icon: 'success',
                            confirmButtonColor: '#004028',
                            allowOutsideClick: false
                        })
                    }
                });
            }); 
            
        });
        </script>
  </body>

</html>