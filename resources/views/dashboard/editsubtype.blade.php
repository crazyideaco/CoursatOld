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
                            <h5>تعديل الحصه </h5>
                        </div>
                            <form method="post" action="{{route('updatesubtype',$subtype->id)}}" enctype="multipart/form-data">
                        	@csrf
                        <div class="info">
                                <div class="row">
                                         <div class="col-3 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="{{asset('uploads/'.$subtype->intro)}}" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br><br>
                               <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
                                        <label for="kt" class="ahmed">اضافة انترو</label>
                                        @error('intro')
                                             <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                        <div class="col-3 text-center set-img">
                                           <img src="{{url('uploads/'.$subtype->image)}}" id="realimg">
                                <br>
                               <input id="ad" type="file" class="form-control ehabtalaat" name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>  <div class="col-3 text-center set-img">
                                           <img src="{{url('uploads/'.$subtype->notes)}}" id="notes1">
                                <br>
                               <input id="notes" type="file" class="form-control ehabtalaat"  name="notes">
                                        <label for="notes" class="ahmed">اضافة notes</label>
                                        @error('notes')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                                     <div class="col-3 text-center set-img">
                                           <img src="{{url('uploads/'.$subtype->part_paper)}}" id="realimg1">
                                <br>
                               <input id="ad1" type="file" class="form-control ehabtalaat" name="part_paper">
                                        <label for="ad1" class="ahmed">اضافة مذكره حصه</label>
                                        @error('part_paper')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                                  </div>
                                       </div>
                             @if(Auth::user() && (Auth::user()->isAdmin == 'admin'
                             ||  Auth::user()->category_id == 1))
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_ar" value="{{$subtype->name_ar}}">
                            @error('name_ar')
                            <div class="alert alert-danger">هذا الحقل مطلوب</div>
                            @enderror
                           </div>
                            <div class="form-group col-3">
                                    <label>اسم الحصه الانجليزي</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_en" value="{{$subtype->name_en}}">
                            @error('name_en')
                            <div class="alert alert-danger">هذا الحقل مطلوب</div>
                            @enderror
                           </div>
                        <div class="form-group col-3">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points" value="{{$subtype->points}}"
                               placeholder="النقاط">
                                      
                                       </div>
                                  <div class="form-group col-3">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points" value="{{$subtype->part_points}}"
                               placeholder="النقاط">
                                      
                                       </div>
                                    <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker"  data-live-search="true"  multiple name="tag_id[]">
                                      
                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}" @if(in_array($tag->id,$subtype->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                                         <div class="form-group col-3">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number" value="{{$subtype->order_number}}" name="order_number">
                               </div>
                          
                                
                                
                            </div>
                            @elseif(Auth::user() && Auth::user()->is_student == 2)
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_ar" value="{{$subtype->name_ar}}">
                            @error('name_ar')
                            <div class="alert alert-danger">هذا الحقل مطلوب</div>
                            @enderror
                           </div>
                            <div class="form-group col-3">
                                    <label>اسم الحصه الانجليزي</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_en" value="{{$subtype->name_en}}">
                            @error('name_en')
                            <div class="alert alert-danger">هذا الحقل مطلوب</div>
                            @enderror
                           </div>
                                 <div class="form-group col-3">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points" value="{{$subtype->points}}"
                               placeholder="النقاط">
                                      
                                       </div>
                                  <div class="form-group col-3">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points" value="{{$subtype->part_points}}"
                               placeholder="النقاط">
                                      
                                       </div>
                                       <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker" data-live-search="true"  multiple name="tag_id[]">
                                      
                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}" @if(in_array($tag->id,$subtype->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                               <div class="form-group col-3">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number"  value="{{$subtype->order_number}}"  name="order_number">
                               </div>
                                </div>
                            
                       
                           
                            @endif
                      <div class="row">
                        <div class="form-group col-6">
                        <label>الوصف</label>
                        <textarea name="description"  class="form-control" rows="5">{{$subtype->description}}</textarea>
                          </div>
                      </div>
                              </div>
                              
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
                   <br><br>
                  
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
$type = \App\Type::where('id',$subtype->type_id)->first();
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
         location.href ='../types';
        }
      }
<?php  }?>
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
        $('#teacher').html(result[0]);
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
       url: `../getteacher/${id}`,//put y
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
       url: `../getteacher/${id}`,//put y
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
       url: `../gettype/${id}/${value}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[0]);
        
       }

      });
}$(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});function readURL(input) {
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
});function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad1").change(function(){
    readURL1(this);
});function writerURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#notes1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#notes").change(function(){
       writerURL1(this);
});
</script>
  @endsection