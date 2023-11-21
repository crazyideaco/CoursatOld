@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
	<!--begin::Card-->
    {{-- <div class="container">

    <div class="card card-custom gutter-b">

        <div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">الاشتراكات
</h3>
										</div>

									</div>


            <!--begin: Datatable-->

    {!! $dataTable->table([

                     ],true) !!}
            <!--end: Datatable-->
 --}}
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



                <div class="search">

                    <input type="text" name="search">
                    <span class="srch"><i class="fas fa-search"></i></span>

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


        <!--start setting-->
        <div class="setting all-products typs">
            <div class="container">
                {{-- <div class="row def">

                    <img src="images/all-products.svg">
                    <h5>الطلاب</h5>



                </div> --}}

                <div class="products-search typs1">


                </div>



                <div class="all-infor">
                    <div class="row" id="category_id_basic">
                        <h4 class="hederre">
                            المرحله الأساسيه
                        </h4>
                        @include('dashboard.students.includes.__basic_filter_sections')
                    </div>


                    <div class="row" id="category_id_college">
                        <h4 class="hederre">
                            المرحله الجامعيه
                        </h4>
                        @include('dashboard.students.includes.__college_filter_sections')
                    </div>
                    {{-- <div class="row">
                        <div class="col-3 mx-auto">


                            <span class="btn btn-primary" onclick="filterbasicstudents()">بحث</span>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="table-responsive">

                            {!! $dataTable->table(
                                [
                                    'class' => 'table_expenses table_topic table table-striped table-bordered',
                                ],
                                true,
                            ) !!}

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!--end setting-->


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
    <!--end::Card-->
@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    {{ $dataTable->scripts() }}
    <script>
        function filter_students() {
            $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
                //basic filters
                data.stage_id = $("#stage").val();
                data.years_id = $("#year").val();
                data.type_id = $("#types").val();
                // //college filters
                data.university_id = $("#university").val();
                data.college_id = $("#college").val();
                data.division_id = $("#division").val();
                data.section_id = $("#section").val();
                data.type_college_id = $("#typescollege").val();
            });
            $('#dataTableBuilder').DataTable().ajax.reload();
        }
    </script>
 @endsection
