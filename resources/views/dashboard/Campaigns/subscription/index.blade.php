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
            @if ($campain->category_id == 1)
                {!! $dataTableBasic->table(
                    [
                        'class' => 'table_expenses table_topic table table-striped table-bordered',
                    ],
                    true,
                ) !!}
            @else
                {!! $dataTableCollege->table(
                    [
                        'class' => 'table_expenses table_topic table table-striped table-bordered',
                    ],
                    true,
                ) !!}
            @endif
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
    @if ($campain->category_id == 1)
        {!! $dataTableBasic->scripts() !!}
    @else
        {!! $dataTableCollege->scripts() !!}
    @endif
@endsection
