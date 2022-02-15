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
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="{{asset('images/setting.svg')}}">
                            <h5>تعديل حصه لايف </h5>
                        </div>
                       <form method="post" action="{{route('updategrouptypelivelesson',$lesson->id)}}" enctype="multipart/form-data">
                        	@csrf
                        <div class="info">
                
                         
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " required name="name_ar"
                            id="name_ar" value="{{$lesson->name_ar}}">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div> <div class="form-group col-4">
                                    <label>يوم الحصه  </label>
                    <input type="date" class="form-control" 
                           required name="date_lesson"
                            id="date_lesson"  value="{{$lesson->date_lesson}}">
                            @error('date_lesson')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div><div class="form-group col-4">
                                    <label>بدايه الحصه   </label>
                    <input type="time" class="form-control" 
                           required name="start_time" value="{{$lesson->start_time}}"
                            id="start_time">
                            @error('start_time')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                            </div>                         
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit"  value="حفظ"  style="cursor:pointer;" class="text-center">
                                </div>
                            </div>
                        </div>
                         </div>
                  </form>
                    </div>
                </div>
            </div>
             <!--</form>-->
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
<script>

    function getyear(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getyear/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#subject').empty();
        $('#subject').html(result);
        
       }

      });
}
 function getteacher(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}

 function getteacher2(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result[0]);
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}

 function getteacher3(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}
 function gettype(selected){
var value=document.getElementById("subject").value;

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `gettype/${id}/${value}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[0]);
        
       }

      });
} 

</script>
  @endsection