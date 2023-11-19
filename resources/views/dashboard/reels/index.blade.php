@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
        width: 100% !important;
    }
</style>
@endsection
@section('content')

<div class="content_page">
    <div class="faq">
        <div class="container">
            <!-- header section -->
            <div class="main_topic">
                <h4>reels</h4>
                <a class="btn first" href="{{route('reels.create')}}"> <i class="bi bi-plus"></i>add reel</a>
            </div>
            <!-- search and filter section -->
            <div class="row">
                <div class="col-12">
                    <div class="search_topic">
                        <div class="table-responsive">
                            {!! $dataTable->table([], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    {{ $dataTable->scripts() }}
 @endsection
