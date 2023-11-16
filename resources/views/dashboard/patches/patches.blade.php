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
    <div class="container">
    <div class="card card-custom gutter-b">

        <div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">QrCode History
</h3>
										</div>
										<div class="card-toolbar">



											<!--end::Button-->
										</div>
									</div>


            <!--begin: Datatable-->

    {!! $dataTable->table([

                     ],true) !!}
            <!--end: Datatable-->


    <!--end::Card-->
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

 @endsection
