@extends('App.dash')
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
                <div class="serv-place">
                    <div class="container">

                        <div class="row def">
                            <img src="{{asset('images/places.svg')}}">
                            <h5> تعديل كلمه السر</h5>

                        </div>


                    
                        <div class="row mt-5">
                            <div class="col-12 text-center">
                                <input type="password" class="form-control editpassword" name="password" id="password" >
                            </div> 
                        </div>

                        <div class="row add">
                            <div class="col-12 text-center">
                                <button class="btn" id="btn" type="button" onclick="updatepassword()">
                                تعديل
                                    <span><i class="fas fa-download"></i></span>
                                    
                                </button>
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

<script>
 function updatepassword(){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
 
    let password  = $('#password').val();
    $.ajax({
       type:"post",
       url: `updatepassword`,
       dataType: "Json",
       data:{
         'password' :password
       },
       success: function(result){
      if(result.status == true){
          Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم  تعديل كلمه السر  بنجاح',
  showConfirmButton: false,
  timer: 1500
})
location.reload();
      }else if(result.status == false){
             Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: result.message,

})
      }
       }

      });
    }</script>
@endsection
