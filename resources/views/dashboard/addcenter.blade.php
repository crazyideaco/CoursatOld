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
                            <h5>اضافه مركز </h5>
                        </div>
                            <form method="post" action="{{route('storecenter')}}" enctype="multipart/form-data">
                        	@csrf
                         
                                    
                                <div class="row">
                            <div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg">
                    <br>
                               <input id="ad" type="file" class="form-control ehabtalaat" required name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                 @error('image')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                           </div>
									<div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg3">
                    <br>
                               <input id="ad3" type="file" class="form-control ehabtalaat"  name="cover_image">
                                        <label for="ad3" class="ahmed">اضافة cover </label>
                                 @error('cover_image')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                               </div><div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg2">
                    <br>
                               <input id="ad2" type="file" class="form-control ehabtalaat"  name="printsplash">
                                        <label for="ad2" class="ahmed">اضافة print splash</label>
                                 @error('printsplash')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                           </div>
                               <div class="col-lg-3 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
                            <label for="kt" class="ahmed">اضافة فيديو</label>
                            @error('intro')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div> 
                            </div>
                        </div>
                          
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>الاسم</label>
                                    <input class="form-control" type="text" name="name">
                                    @error('name')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>الايميل</label>
                                    <input class="form-control" type="text" name="email">
                                    @error('email')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>كلمه السر</label>
                                    <input class="form-control" type="password" name="password">
                                    @error('password')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                                </div>
                                  <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>الهاتف</label>
                                    <input class="form-control" type="text" name="phone">
                                    @error('phone')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group col-lg-3 col-md-6 col-12">
                      <select name="state_id" class="form-control" onchange="getcity(this)">
                          <option value="state_id" selected="selected" disabled>اختر محافظه</option>
                          @foreach($states as $state)
                          <option value="{{$state->id}}">{{$state->state}}</option>
                          @endforeach
                          </select>
                          </div>
                             <div class="form-group col-lg-3 col-md-6 col-12">
                      <select name="city_id" class="form-control" id="city">
                          <option value="city_id" selected="selected" disabled>اختر مدينه</option>
                          
                          </select>
                          </div>
                           <div class="form-group col-lg-3 col-md-6 col-12">
                               <input type="text" name="address" class="form-control" placeholder="ادخل العنوان">
                               @error('address')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
								 <div class="form-group col-lg-3 col-md-6 col-12">
                                         
                                         <select class="form-control" name="category_id">
                                             <option value="0" slected="selected" disaled="disabled"> نوع المركز</option>
                                          @foreach($categories as $category)
                            
                                       <option value="{{$category->id}}">{{$category->name}}</option>
                                 
                                   @endforeach
                                     </select>
                                </div>
                            </div>
                          
                   <br><br>
                         <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                        
                           <div class="row">
                               <div class="form-group col-12">
                                   <label>الوصف</label>
                                   <textarea class="form-control" rows="5" name="description"></textarea>
                                   @error('description')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                               </div>
                           </div>

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
          $('#success').html('<span class="text-danger"><b>'+data.errors+'</b><br/></span>');
        }
        if(data.success)
        {
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
         location.href ='centers';
        }
      }
    });
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad").change(function(){
    readURL(this);
});
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
       url: `getcity/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#city').empty();
       $('#city').html(result);
       console.log(result);
       }

      });
    }


    function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
       }

      });
  }
  function getsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  }
  function getsubcollege(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  }$(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad2").change(function(){
    readURL2(this);
});  function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad3").change(function(){
    readURL3(this);
});
</script>
@endsection