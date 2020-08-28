@extends('adminlte::page')

@section('title', 'Employees')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="box-title">Employees list</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-td-valign-middle yajra-datatable" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>UID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Date of employment</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <a class="btn btn-success" href="{{ route('admin.employees.add') }}">Add</a>
        </div>
    </div>


@stop

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.employees') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: true,
                        searchable: true
                    },
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position_id'},
                    {data: 'emp_date', name: 'emp_date'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'wage', name: 'wage'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@stop
