@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
    .all-products button {
    width: 81px !important;
    color: #ffffff;
     font-family: 'light' !important;
    font-size: 19px !important;
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
                            <img src="{{asset('images/profile.svg')}}">
                        </div>
                        <div class="col-6">
                            <h5>{{auth()->user()->name}}</h5>
                            <p>ادمن</p>

                        </div>


                            </div>
                        </div>
                        <div class="flag">

                            <div class="row">
                                <div class="col-4">
                                    <img src="{{asset('images/flag.svg')}}">
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
                                <p>{{ Carbon\Carbon::now()->format('d-m-Y')}}</p>
                            </div>
                        </div>


                    </div>


                </div>
                <!--end heed-->


                <!--start setting-->
                <div class="setting all-products typs">
                    <div class="container">
                        <div class="row def">

                            <img src="{{asset('images/all-products.svg')}}">
                            <h5>  طلبات الانضمام</h5>



                        </div>

                        <div class="products-search typs1">
                            <div class="row">





                                <div class="col-4">

                                </div>



                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">

                                <div class="row">
                                    <div class="table-responsive">

                                        <img src="{{ route('screenshot_session') }}" alt="Screenshot Image">
                                    </div>



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
                        <h5>Made With <img src="{{asset('images/red.svg')}}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->


@endsection
@section("scripts")
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


<script>
//   $(document).ready(function() {
    $('#example').DataTable({
	"order": [[ 0, "desc" ]], // Order on init. # is the column, starting at 0});
  columnDefs: [
      {
         targets: 0,
      visible : false,


      },]

});
function accept_type_join(sel){
    let id = sel;

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `accept_type_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
      result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-success p-2">تم القبول</span>');
       }
           }

    });
    }function refuse_type_join(sel){
    let id = sel;

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `refuse_type_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
         result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-danger p-2">تم الرفض</span>');
       }
           }

    });
    }

</script>
@endsection
