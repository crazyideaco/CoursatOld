<style>
    h3.card-label {
    font-family: 'med';
}
.card-toolbar a.btn.first {
    background-color: #243e56;
    color: white;
    font-family: 'reg';

}
.table tbody tr td {
    background: unset !important;
}
.table thead tr th {
    background: unset !important;
}
div#dataTableBuilder_wrapper {
    border: 1px solid #0000000f !important;
    font-family: 'med';
}
button {
    background-color: #243e56 !important;
    color: white !important;
    border: unset !important;
    font-family: 'reg';
    border-radius: 10px !important;
    padding: 0.5rem 1rem !important;
    margin-right: 27px !important;
    cursor:  !important;
}
div#dataTableBuilder_length {
    margin-top: 19px;
}
</style>



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
											<h3 class="card-label">الفيديوهات القصيره
</h3>
										</div>
										<div class="card-toolbar">

                                            <a class="btn first" href="{{route('reels.create')}}"> <i class="bi bi-plus"></i>اضافه فيديو قصير +</a>

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

    {{ $dataTable->scripts() }}
 @endsection
