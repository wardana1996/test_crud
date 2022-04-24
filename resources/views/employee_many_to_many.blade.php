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
                    <a class="nav-link" href="{{ route('employee.index') }}">Employee One To One</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_to_many.index') }}">Employee One To Many</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_many_to_many.index') }}">Employee Many To Many</a>
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
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Member</label>
                                    <div class="col-sm-8">
                                        <select name="member_id" id="member_id" class="form-control form-control-sm customer" style='width: 300px;' >
                                            <option value="" hidden>-- choose member --</option>
                                        </select>
                                        <span class="text-danger small" id="member_iderror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Brand Phone</label>
                                    <div class="col-sm-8">
                                        <select name="brand_id" id="brand_id" class="form-select form-control-sm">
                                            <option value="" hidden>-- choose brand --</option>
                                            <option value="1">Apple</option>
                                            <option value="2">Samsung</option>
                                        </select>
                                        <span class="text-danger small" id="brand_iderror"></span>
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
                <select class="form-select " id="searchBrand" aria-label="Default select example" required>
                    <option value="" hidden>-- choose brand --</option>
                    <option value="1">Apple</option>
                    <option value="2">Samsung</option>
                </select>
            </div>
            <br>
            <div class="table-responsive">
                <table class="display" id="employeeTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Member Name</th>
                            <th>Brand Name</th>
                            <th>Description</th>
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
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Member</label>
                                <div class="col-sm-8">
                                    <select id="member_id_edit" name="member_id_selected" class="form-control form-control-sm member_id" style='width: 300px;'>
                                        <option value="" hidden></option>
                                    </select>
                                    <input type="hidden" name="member_id" id="member_id_box"/>
                                    <span class="text-danger small" id="member_iderrorupdate"></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Brand Phone</label>
                                <div class="col-sm-8">
                                    <selec id="brand_id_edit" name="brand_id_selected" class="form-select form-control-sm brand_id">
                                        <option value="" hidden>-- choose brand --</option>
                                        <option value="1">Apple</option>
                                        <option value="2">Samsung</option>
                                    </select>
                                    <input type="hidden" name="brand_id" id="brand_id_box"/>
                                    <span class="text-danger small" id="brand_iderrorupdate"></span>
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
    
            var table = $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength : 6,
                lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
                ajax: {
                    url: "{{ route('employee_many_to_many.index') }}",
                    type: 'GET',
                    data: function (d) {
                        d.brand_id = $('#searchBrand').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[0, 'desc']]
            });

            $("#searchBrand").change(function(){
                table.draw();
            });

            $("#member_id").select2({
                theme: 'bootstrap-5',
                ajax: { 
                    url: "{{ route('employee_many_to_many.member') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                    return {
                        _token: "{{csrf_token()}}",
                        search: params.term
                    };
                },
                processResults: function (response , params) {
                    return {
                    results: response,
                    };
                },
                cache: true
                }
            });

            $(document).on('submit', '#formCreate', function(event){  
                event.preventDefault();  
                var member_id = $('#member_id').val();    
                var brand_name = $('#brand_id').val();   
                $.ajax({
                    url: "{{ route('employee_many_to_many.create') }}",
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
                        $('#member_id').val(null).trigger('change');
                        $('#modalCreate').modal('hide');  
                        $('#employeeTable').DataTable().ajax.reload( null, false ); 
                    },
                    error:function (response) {
                        $("#member_iderror").hide().text(response.responseJSON.errors.member_id).fadeIn('slow').delay(2000).hide(1);
                        $("#brand_iderror").hide().text(response.responseJSON.errors.brand_id).fadeIn('slow').delay(2000).hide(1);
                    }
                })
            });

            $(document).on("click", ".editBrand", function () {
                var id = $(this).data('id');
                $.ajax({
                    type:"POST",
                    url: "{{ url('/employee_many_to_many/edit') }}"+'/'+id,
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        $('#modalEdit').modal('show');
                        $('#id').val(res.id);
                        $('#member_id_edit').val(res.member_id);
                        $('#member_id_box').val(res.member_id);
                        $('.member_id').select2({
                            placeholder: res.name,
                            theme: 'bootstrap-5',
                            ajax: { 
                                url: "{{ route('employee_many_to_many.member') }}",
                                type: "post",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    return {
                                        _token: "{{csrf_token()}}",
                                        search: params.term
                                    };
                                },
                                processResults: function (response , params) {
                                    return {
                                        results: response,
                                    };
                                },
                                cache: true
                            }
                        });
                        $('#brand_id_edit').val(res.brand_id);
                        $('#brand_id_box').val(res.brand_id);
                        $('.brand_id').select2({
                            theme: 'bootstrap-5',
                            placeholder: res.brand_name,
                        });
                    }
                });
            });

            $('select[name="member_id_selected"]').on('change', function() {
                var memberId = $(this).val();
                $('#member_id_box').val(memberId);  
            });

            $('select[name="brand_id_selected"]').on('change', function() {
                var brandId = $(this).val();
                $('#brand_id_box').val(brandId);  
            });

            $(document).on('click', '#buttonUpdate', function(event){  
                event.preventDefault(); 
                var member_id = $('#member_id_edit').val();
                var brand_id = $('#brand_id_edit').val();  
                var id = $('#id').val();  
                $.ajax({
                    url: "{{ url('/employee_many_to_many/update') }}"+'/'+id,
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
                        $('#employeeTable').DataTable().ajax.reload( null, false );      
                    },
                    error:function (response) {
                        $("#member_iderrorupdate").hide().text(response.responseJSON.errors.member_id).fadeIn('slow').delay(2000).hide(1);
                        $("#brand_iderrorupdate").hide().text(response.responseJSON.errors.brand_id).fadeIn('slow').delay(2000).hide(1);
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
                            url: "{{ url('/employee_many_to_many/delete') }}"+'/'+id,
                            cache: false,
                            method:"DELETE",  
                            data: { id: id },
                            success: function(data){
                                $('#employeeTable').DataTable().ajax.reload( null, false );       
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