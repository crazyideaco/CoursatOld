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
                 @error('name')
   <p style="margin: 33px auto;
    background: #dc354559;
    color: #dc3545;
    font-weight: bold;
    text-align: center;
    border-radius: 5px;
    padding: 10px 20px;
    box-shadow: 0px 3px 6px #dc35454d;
     }">{{ $message }}</p>
   @enderror
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="{{asset('images/setting.svg')}}">
                            <h5>تعديل فيديو </h5>
                        </div>
                         
                       <form method="post" action="{{route('updatevideosgeneral',$video->id)}}" enctype="multipart/form-data">
                        	@csrf
                                <div class="row">
                               <input type="hidden" value="{{$video->id}}" id="id">
                            <div class="col-6 text-center set-img">
                                         <video width="200" height="200" controls >
              <source src="{{asset('uploads/'.$video->url)}}" id="video_here">
            Your browser does not support HTML5 video.
          </video>
         <br>
                               <input id="kt" type="file" class="form-control ehabtalaat"   name="url">
                                        <label for="kt" class="ahmed">اضافة فيديو</label>
                                        @error('url')
                                    <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                       
                                       <div class="col-6 text-center set-img">
                                             <canvas id="pdfViewer" style="width:200px;height:200px"></canvas>
                                              <br>
                               <input id="myPdf" type="file" class="form-control ehabtalaat"   name="pdf">
                                        <label for="myPdf" class="ahmed">اضافة pdf</label>
                                        @error('pdf')
                                    <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                       
                                       
                                       <div class="col-6 text-center set-img">
                               <input id="ad" type="file" class="form-control ehabtalaat"  name="image">
                                         <img src="{{asset('uploads/'.$video->image)}}" id="realimg">
                                <br>
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                    <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                           
                             <div class="col-6 text-center set-img">
                                           <img src="{{asset('uploads/'.$video->board)}}" id="realimg2">
                                <br>
                               <input id="ad2" type="file" class="form-control ehabtalaat"  name="board">
                                        <label for="ad2" class="ahmed">سبوره الحصه</label>
                                        @error('board')
                                    <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                
                                        </div>
                                        </div>
                        	 @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                           
                        
                        <div class="info">
                            <div class="row">
                               <div class="form-group col-3">
                              <label>عنوان الفيديو بالعربى </label>
                   <input type="text" class="form-control" id="name_ar" required value="{{$video->name_ar}}" name="name_ar">
                           </div>           
                           <div class="form-group col-3">
                              <label>عنوان الفيديو بالانجليزي </label>
                   <input type="text" class="form-control" id="name_en" required value="{{$video->name_en}}"  name="name_en">
                           </div>
        
                            <div class="form-group col-3">
                                     
                                   <label for="pay">مدفوع</label><br >
                               <input id="pay" style="width: 13px;" type="checkbox" @if($video->paid == 1) checked @endif value="1" name="pay">
                                 
                               </div>
                         
                            </div>
                        
                  
                    
                    
                    
                           <div class="row">
                               <div class="form-group col-6">
                                  
                                   <label>الوصف بالعربيه</label>
                                   <textarea class="form-control " rows="5" id="description_ar" name="description_ar">{{$video->description_ar}}</textarea>
                               </div>
                                <div class="form-group col-6">

                                   <label>الوصف بالانجليزيه</label>
                                   <textarea class="form-control " rows="5" id="description_en" name="description_en">{{$video->description_en}}</textarea>
                               </div>
                           </div>
                           @elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 3)
                     <div class="info">
                            <div class="row">
                               <div class="form-group col-3">
                              <label>عنوان الفيديو بالعربى </label>
                   <input type="text" class="form-control" id="name_ar" required value="{{$video->name_ar}}" name="name_ar">
                           </div>           
                           <div class="form-group col-3">
                              <label>عنوان الفيديو بالانجليزي </label>
                   <input type="text" class="form-control" id="name_en" required value="{{$video->name_en}}"  name="name_en">
                           </div>
        
                            <div class="form-group col-3">
                                     
                                   <label for="pay">مدفوع</label><br >
                               <input id="pay" style="width: 13px;" type="checkbox" @if($video->paid == 1) checked @endif value="1" name="pay">
                                 
                               </div>
                         
                            </div>
                        
                  
                    
                    
                    
                           <div class="row">
                               <div class="form-group col-6">
                                  
                                   <label>الوصف بالعربيه</label>
                                   <textarea class="form-control " rows="5" id="description_ar" name="description_ar">{{$video->description_ar}}</textarea>
                               </div>
                                <div class="form-group col-6">

                                   <label>الوصف بالانجليزيه</label>
                                   <textarea class="form-control " rows="5" id="description_en" name="description_en">{{$video->description_en}}</textarea>
                               </div>
                           </div>
                           @elseif(Auth::user() &&Auth::user()->is_student == 4)
                           
                    <div class="info">
                            <div class="row">
                               <div class="form-group col-3">
                              <label>عنوان الفيديو بالعربى </label>
                   <input type="text" class="form-control" id="name_ar" required value="{{$video->name_ar}}" name="name_ar">
                           </div>           
                           <div class="form-group col-3">
                              <label>عنوان الفيديو بالانجليزي </label>
                   <input type="text" class="form-control" id="name_en" required value="{{$video->name_en}}"  name="name_en">
                           </div>
        
                            <div class="form-group col-3">
                                     
                                   <label for="pay">مدفوع</label><br >
                               <input id="pay" style="width: 13px;" type="checkbox" @if($video->paid ==1) checked @endif value="1" name="pay">
                                 
                               </div>
                         
                            </div>
                        
                  
                    
                    
                    
                           <div class="row">
                               <div class="form-group col-6">
                                  
                                   <label>الوصف بالعربيه</label>
                                   <textarea class="form-control " rows="5" id="description_ar" name="description_ar">{{$video->description_ar}}</textarea>
                               </div>
                                <div class="form-group col-6">

                                   <label>الوصف بالانجليزيه</label>
                                   <textarea class="form-control " rows="5" id="description_en" name="description_en">{{$video->description_en}}</textarea>
                               </div>
                           </div>
                                 @endif
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
        
                <?php
$msg = null;
$type = \App\Course::where('id',$video->course_id)->first();
if(auth()->user() && auth()->user()->isAdmin == 'admin'){
      
    $paqauser= \App\Paqa_User::with("paqa")->where("user_id",$type->user_id)->first();
    if($paqauser==null){
     $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
    //   return response()->json(['status' => false,'errors' => $msg]);
}
   elseif($paqauser->expired_at ==\Carbon\Carbon::now()->format('Y-m-d')){
            $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);

  }
} elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
  $paqauser= \App\Paqa_User::with("paqa")->where("user_id",auth()->user()->id )->first();
  if($paqauser==null){
   $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
   //  return response()->json(['status' => false,'errors' => $msg]);
}
 elseif($paqauser->expired_at == \Carbon\Carbon::now()->format('Y-m-d')){
         $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);
}
}if(Auth::user() && Auth::user()->is_student == 2){
             
  $paqauser= \App\Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
  if($paqauser==null){
    $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
    // return response()->json(['status' => false,'errors' => $msg]);
}
 elseif($paqauser->expired_at ==\Carbon\Carbon::now()->format('Y-m-d')){
           $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);
}}?>
         /* $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');*/
        var message= '<?php echo $msg;?>';
          $('#success').html('<span class="text-danger"><b>'+message+'</b></span><br /><br />');
      },
  <?php   if($msg){
     }else{ ?>
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
<?php  }?>
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
 
// //get subtype
  
//   function getsubtype(selected){

// var id = selected.value;
//  console.log(id);
//   $.ajax({
//       type:"GET",
//       url: `getsubtype/${id}`,//put y
//       contentType: "application/json; charset=utf-8",
//       dataType: "Json",
//       success: function(result){
//           console.log(result);
//         $('#subtype').empty();
//         $('#subtype').html(result);
        
//       }

//       });
// }
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
       url: `getsub/${id}`,
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
function getcourse(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcourse/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#course').empty();
       $('#course').html(result);
       console.log(result);
       }

      });
    }
  
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad").change(function(){
    readURL(this);
});
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad2").change(function(){
    readURL2(this);
});
</script>

<script>
  
  $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});
</script>
  @endsection