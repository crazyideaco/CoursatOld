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
                            <h5>تعديل كورس </h5>
                        </div>
                            <form method="post" action="{{route('updatecourse',$course->id)}}" enctype="multipart/form-data">
                        	@csrf
                         
                              <div class="row">
                                         <div class="col-lg-6 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="{{url('uploads/'.$course->intro)}}" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br><br>
                               <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
                                        <label for="kt" class="ahmed">اضافة انترو</label>
                                        @error('intro')
                                             <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                        <div class="col-lg-6 col-md-6 col-12 text-center set-img">
                                           <img src="{{url('uploads/'.$course->image)}}" id="realimg">
                                <br>
                               <input id="ad" type="file" class="form-control ehabtalaat" name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                                       </div>      
                            @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس بالعربى</label>
                                    <input class="form-control" type="text" required name="name_ar" value="{{$course->name_ar}}">
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس  بالانجليزيه</label>
                                    <input class="form-control" type="text" required name="name_en" value="{{$course->name_en}}">
                                </div>
                                  <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>القسم العام</label>
                      <select name="general_id" class="form-control" required onchange="getsub(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم عام
                          </option>
                          @foreach($generals as $general)
                          <option value="{{$general->id}}"
                          @if($course->general_id == $general->id)  selected @endif >{{$general->name_ar}}</option>
                          @endforeach
                      </select>
                           </div>
                     <div class="form-group col-lg-3 col-md-6 col-12">
                         <label>القسم فرعى</label>
                        <select name="sub_id" class="form-control" id="sub"  onchange="getlecturer(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم فرعى
                          </option>
                          @foreach($subs as $sub)
                          <option value="{{$sub->id}}"
                          @if($course->sub_id == $sub->id) selected @endif >{{$sub->name_ar}}</option>
                          @endforeach
                      </select>
                        </div>
                           <div class="form-group col-lg-3 col-md-6 col-12">
                         <label>اختر محاضر </label>
                        <select name="user_id" class="form-control" id="lecturer">
                          <option value="0" selected="selected" disabled>
                              اختر محاضر
                          </option>
                         @foreach($users as $user)
                          <option value="{{$user->id}}"
                          @if($course->user_id == $user->id) selected @endif >{{$user->name}}</option>
                          @endforeach
                      </select>
                        </div>
                        
                        <div class="form-group col-lg-3 col-md-6 col-12">
                               <label>عدد النقط</label>
                               <input  type="number" name="points" value="{{$course->points}}">
                               </div>
                        
                        </div>
                            </div>
                              @elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3)
                                 <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس بالعربى</label>
                                    <input class="form-control" type="text" required name="name_ar" value="{{$course->name_ar}}">
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس  بالانجليزيه</label>
                                    <input class="form-control" type="text" required name="name_en" value="{{$course->name_en}}">
                                </div>
                                  <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>القسم العام</label>
                      <select name="general_id" class="form-control" required onchange="getsub(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم عام
                          </option>
                          @foreach($generals as $general)
                          <option value="{{$general->id}}"
                          @if($course->general_id == $general->id) selected @endif >{{$general->name_ar}}</option>
                          @endforeach
                      </select>
                           </div>
                     <div class="form-group col-lg-3 col-md-6 col-12">
                         <label>القسم فرعى</label>
                        <select name="sub_id" class="form-control" id="sub"  onchange="getlecturer(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم فرعى
                          </option>
                          @foreach($subs as $sub)
                          <option value="{{$sub->id}}"
                          @if($course->sub_id == $sub->id) selected @endif >{{$sub->name_ar}}</option>
                          @endforeach
                      </select>
                        </div>
                           <div class="form-group col-lg-3 col-md-6 col-12">
                         <label>اختر محاضر </label>
                        <select name="user_id" class="form-control" id="lecturer">
                          <option value="0" selected="selected" disabled>
                              اختر محاضر
                          </option>
                         @foreach($users as $user)
                          <option value="{{$user->id}}"
                          @if($course->user_id == $user->id) selected @endif >{{$user->name}}</option>
                          @endforeach
                      </select>
                        </div>
                        
                        <div class="form-group col-lg-3 col-md-6 col-12">
                               <label>عدد النقط</label>
                               <input  type="number" name="points" value="{{$course->points}}">
                               </div>
                        
                        </div>
                            </div>
                         @elseif(Auth::user() &&Auth::user()->is_student == 4)
                          <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس بالعربى</label>
                                    <input class="form-control" required type="text" name="name_ar" value="{{$course->name_ar}}">
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                  <label>اسم الكورس  بالانجليزيه</label>
                                    <input class="form-control"required type="text" name="name_en" value="{{$course->name_en}}">
                                </div>
                                 
                     <div class="form-group col-lg-3 col-md-6 col-12">
                         <label>القسم فرعى</label>
                        <select name="sub_id" class="form-control" id="sub" required onchange="getlecturer(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم فرعى
                          </option>
                          @foreach($subs as $sub)
                          <option value="{{$sub->id}}"
                          @if($course->sub_id == $sub->id) selected @endif >{{$sub->name_ar}}</option>
                          @endforeach
                      </select>
                        </div>
                       
                        
                        <div class="form-group col-lg-3 col-md-6 col-12">
                               <label>عدد النقط</label>
                               <input  type="number" name="points" value="{{$course->points}}">
                               </div>
                        
                        </div>
                            </div>
                         @endif
                         <div>
                           <div class="form-group col-lg-6 col-md-6 col-12">
                                   <label>الوصف </label>
                                   <textarea class="form-control" rows="5" name="description">{{$course->description}}</textarea>
                               </div>
                               </div>
                                                   <br><br>
                         <div class="progress px-3">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                    </form>
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
<script>
    $('form').ajaxForm({
      beforeSend:function(){
        $('#success').empty();
      },
      uploadProgress:function(event, position, total, percentComplete)
      {
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
        if(data.errors)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
        }
        if(data.success)
        {
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
         location.href ='../course';
        }
      }
    });
    function getyear(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `../getyear/${id}`,//put y
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
       url: `../getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result);
        
       }

      });
}

function getcity(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getcity/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#city').empty();
       $('#city').html(result);
       console.log(result);
       }

      });
    }

function getsub(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getsub/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#sub').empty();
       $('#sub').html(result);
       console.log(result);
       }

      });
    }

function getlecturer(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getlecturer/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#lecturer').empty();
       $('#lecturer').html(result);
       console.log(result);
       }

      });
    }

</script>
@endsection