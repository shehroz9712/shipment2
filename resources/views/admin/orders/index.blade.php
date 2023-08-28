@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Shipping Data</h2>
                <table class="table table-bordered data-table">
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
