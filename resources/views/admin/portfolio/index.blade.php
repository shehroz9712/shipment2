@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service ID</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Is on Home</th>
                            <th>Order</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            @section('js')
                <script>
                    $(function() {

                        var table = $('.data-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('portfolio.index') }}",
                            columns: [{
                                    data: 'id',
                                    name: 'id'
                                },
                                {
                                    data: 'service_id',
                                    name: 'service_id'
                                },
                                {
                                    data: 'image',
                                    name: 'image'
                                },
                                {
                                    data: 'status',
                                    name: 'status'
                                },
                                {
                                    data: 'is_on_home',
                                    name: 'is_on_home'
                                },
                                {
                                    data: 'order',
                                    name: 'order'
                                },
                                {
                                    data: 'created_at',
                                    name: 'created_at'
                                },
                                {
                                    data: 'updated_at',
                                    name: 'updated_at'
                                    s
                                },
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
                                    searchable: false
                                }
                            ]
                        });

                    });
                </script>
            @endsection
            {{-- @dd($attendance_all); --}}
        </div>
    </div>
</div>
@endsection
