@extends('App.dash')
@section('style')
    <style>
        #example_wrapper {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <!--start page-body-->
    <div class="page-body">
        <div class="container">
            <!--start heed-->
            <div class="heed">
                <div class="row">
                    <div class="profile">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset('images/profile.svg') }}">
                            </div>
                            <div class="col-6">
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>ادمن</p>
                            </div>
                        </div>
                    </div>
                    <div class="flag">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('images/flag.svg') }}">
                            </div>
                            <div class="col-4">
                                <h5>العربية</h5>
                            </div>
                        </div>
                    </div>
                    <div class="noti text-center">
                        <span><i class="far fa-bell"></i></span>
                    </div>
                    <div class="datee">
                        <div class="row">
                            <span><i class="far fa-calendar-alt"></i></span>
                            <p>{{ Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end heed-->

            <!--start table-->
            {!! $dataTable->table(
                [
                    'class' => 'table_expenses table_topic table table-striped table-bordered',
                ],
                true,
            ) !!}
            <!--end table-->
            <!--start foter-->
            <div class="foter">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>Made With <img src="{{ asset('images/red.svg') }}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
    {{-- <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function deletetag(sel) {
            let id = sel;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'هل انت متاكد؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "Post",
                        data: {
                            '_method': 'DELETE',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `campaigns/${id}`,
                        //    contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        success: function(result) {
                            $(`#c${id}`).remove();
                            Swal.fire(
                                'Deleted!',
                                'تم مسح وسيلة الدفع بنجاح',
                                'success'
                            )
                        }

                    });
                }


            })
        }
    </script> --}}
@endsection
