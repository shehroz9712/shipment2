@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Shipment Data</div>

                    <div class="card-body">
                        <a href="{{ route('users.create') }}" class="btn btn-primary mb-4" style="float: right;">Create Shipment</a>
                        <table class="table table-responsive data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Shipment Address</th>
                                    <th>Contact</th>
                                    <th>Tracking ID</th>
                                    <th>Rate Charges</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@section('js')
    <script>
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'shipment_address',
                        name: 'shipment_address'
                    },
                    {
                        data: 'contact',
                        name: 'contact'
                    },
                    {
                        data: 'track_id',
                        name: 'track_id'
                    },
                    {
                        data: 'rate_charges',
                        name: 'rate_charges'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false, // Disable sorting for this column
                        searchable: false // Disable searching for this column
                    }
                ]
            });

        });
    </script>
@endsection

@endsection
