@extends('App.dash')
<style>
.btn-light:not(:disabled):not(.disabled).active, .btn-light:not(:disabled):not(.disabled):active, .show>.btn-light.dropdown-toggle{
  width:100%;
}
  .setting .info button{
    width:100%;
  }</style>
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
                            <h5>اضافه حصه </h5>
                        </div>
                       <form method="post" action="{{route('storesubtype',$id)}}" enctype="multipart/form-data">
                        	@csrf
                        <div class="info">
                              <div class="row">
                                         <div class="col-3 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br><br>
          <input type="hidden" value="{{$id}}" id="id2">
                              <input id="kt" type="file" onchange="getvid()" class="form-control in ehabtalaat" name="intro">
                                        <label for="kt" class="ahmed">اضافة انترو</label>

                                        @error('intro')
                                             <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                        <div class="col-3 text-center set-img">
                                           <img src="{{asset('images/set-img.svg')}}" id="realimg">
                                <br>
                               <input id="ad" type="file" class="form-control ehabtalaat"  name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>           <div class="col-3 text-center set-img">
                                           <img src="{{asset('images/set-img.svg')}}" id="notes1">
                                <br>
                               <input id="notes" type="file" class="form-control ehabtalaat"  name="notes">
                                        <label for="notes" class="ahmed">اضافة notes</label>
                                        @error('notes')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                                          <div class="col-3 text-center set-img">
                                                   <img src="{{asset('images/set-img.svg')}}" id="realimg1">
                                <br>
                               <input id="ad1" type="file" class="form-control ehabtalaat" name="part_paper">
                                        <label for="ad1" class="ahmed">اضافة مذكره حصه</label>
                                        @error('part_paper')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                                  </div>
                                       </div>
                             @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " required name="name_ar"
                            id="name_ar">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                           <div class="form-group col-4">
                                    <label>اسم الحصه بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " required name="name_en"
                            id="name_en">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>


                              <div class="form-group col-3">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">

                                       </div>
                                  <div class="form-group col-3">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">

                                       </div>
                              <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker" data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                                       <div class="form-group col-3">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number" name="order_number">
                               </div>

                                </div>

                  @elseif(Auth::user() && Auth::user()->is_student == 2)
                  <?php
                   $iduser=Auth::user()->id;
                         $useryear= \App\User_Year::where('user_id',$iduser)->pluck('year_id');
                        $userstage= \App\Stage_User::where('user_id',$iduser)->pluck('stage_id');

                       $yearr= \App\Year::whereIn('id',$useryear)->get();
                       $stages= \App\Year::whereIn('id',$userstage)->get();


                  ?>
                              <div class="row">
                                <div class="form-group col-3">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_ar" required id="name_ar">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                           <div class="form-group col-3">
                                    <label>اسم الحصه بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_en" required id="name_en">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                    <div class="form-group col-3">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">

                                       </div>
                                  <div class="form-group col-3">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">

                                       </div>
                                       <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker " data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                                       <div class="form-group col-3">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number" name="order_number">
                               </div>

                                </div>
                            </div>
                            @elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1)
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>اسم الحصه بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_ar" required id="name_ar">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                            <div class="form-group col-3">
                                    <label>اسم الحصه بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_en" required id="name_en">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                             <div class="form-group col-3">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">

                                       </div>
                                  <div class="form-group col-3">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">

                                       </div>
                                          <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker " data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                 <div class="form-group col-3">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number" name="order_number">
                               </div>
                                </div>

                            @endif
                   <div class="form-group col-6">
                                   <label>الوصف </label>
                                   <textarea class="form-control" rows="5" name="description"></textarea>
                               </div>
                      </div>
                         </div>
{{--                            <section id="s0" >--}}
{{--                            <div class="row">--}}
{{--                               <div class="col-6 text-center mb-5 set-img">--}}
{{--                    <video width="200" height="200" controls >--}}
{{--              <source src="mov_bbb.mp4" id="video_here0">--}}
{{--            Your browser does not support HTML5 video.--}}
{{--          </video>--}}
{{--          <br>--}}
{{--          <br>--}}
{{--                   <input id="kt0"  type="file" onchange="getvideo(0)" class="form-control url ehabtalaat" required name="url[]">--}}
{{--                            <label for="kt0" class="ahmed">اضافة فيديو</label>--}}
{{--                            @error('url')--}}
{{--                            <p style="color:red;">{{$message}}</p>--}}
{{--                            @enderror--}}
{{--                           </div><div class="col-6 text-center set-img">--}}
{{--                            <canvas class="pdfViewer" style="width:200px;height:200px"></canvas>--}}
{{--                   <input id="myPdf0" type="file" class="form-control pdf ehabtalaat" name="pdf[]">--}}
{{--                   <br>--}}
{{--<br>--}}
{{--                            <label for="myPdf0" class="ahmed">اضافة pdf</label>--}}
{{--                            @error('pdf')--}}
{{--                            <p style="color:red;">{{$message}}</p>--}}
{{--                            @enderror--}}
{{--               </div>--}}
{{--                           <div class="col-6 text-center set-img">--}}
{{--                               <img src="{{asset('images/set-img.svg')}}" id="r0" class="realimg">--}}
{{--                    <br>--}}
{{--                   <input id="d0" type="file" class="form-control image ehabtalaat"  onchange="getimage(0)" name="images[]">--}}
{{--                            <label for="d0" class="ahmed">اضافة صوره</label>--}}
{{--                            @error('image')--}}
{{--                            <p style="color:red;">{{$message}}</p>--}}
{{--                            @enderror--}}
{{--               </div>--}}

{{--                            <div class="col-6 text-center set-img">--}}
{{--                                <img src="{{asset('images/set-img.svg')}}" id="b0" class="realboard">--}}
{{--                                <br>--}}
{{--                               <input id="real0" type="file" class="form-control board ehabtalaat"  onchange="getboard(0)" name="boards[]">--}}
{{--                                        <label for="real0" class="ahmed">سبوره الحصه</label>--}}
{{--                                        @error('board')--}}
{{--                                        <p style="color:red;">{{$message}}</p>--}}
{{--                                        @enderror--}}
{{--                           </div>--}}

{{--                            </div>--}}
{{--                            <div class="row mt-5">--}}
{{--                                     <div class="form-group col-4">--}}
{{--                                  <input id="name_ar" type="text" class="form-control name_ar" required style="width:100%" name="names_ar[]"--}}
{{--                               placeholder="عنوان الفيديو بالعربى ">--}}
{{--                               </div>  <div class="form-group col-4">--}}
{{--                                  <input id="name_en" type="text" class="form-control name_en" required style="width:100%" name="names_en[]"--}}
{{--                               placeholder="عنوان الفيديو بالانجليزي ">--}}
{{--                               </div>--}}
{{--                               <div class="col-1"></div>--}}
{{--                           <div class="form-group col-3">--}}
{{--                               <label for="pay" class="paylabel">مدفوع</label>--}}
{{--                               <input class="pay" type="checkbox"  value="1" name="pay[]">--}}
{{--                               <br>--}}

{{--                           </div>--}}
{{--                                     <div class="col-6">--}}
{{--                                 <label>التاج </label>--}}
{{--                                <select class="form-control selectpicker "data-live-search="true"  multiple name="tag_id[]">--}}

{{--                                  @foreach($tags as $tag)--}}
{{--                                  <option value="{{$tag->id}}">{{$tag->name}}</option>--}}
{{--                                  @endforeach--}}
{{--                                </select>--}}
{{--                              </div>--}}
{{--                           <div class="form-group col-3">--}}
{{--                               <label>ترتيب الفيديو </label>--}}
{{--                               <input style="height: 36px;" min="0" type="number" name="order[]">--}}
{{--                               </div>--}}
{{--                            </div>--}}
{{--                             <div class="row">--}}
{{--                               <div class="col-6">--}}
{{--                                   <label>الوصف بالعربى</label>--}}
{{--                                   <textarea class="description_ar form-control" rows="6" name="description_ar[]"></textarea>--}}
{{--                               </div>--}}
{{--                               <div class="col-6">--}}
{{--                                   <label>الوصف بالانجليزي</label>--}}
{{--                                   <textarea class="description_en form-control" rows="6" name="description_en[]"></textarea>--}}
{{--                               </div>--}}
{{--                           </div></section>--}}
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
                                  <input type="button" id="clicked" value="اضافه المزيد" class="text-center">
                                </div>
                            </div>
                        </div>
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit"  value="حفظ"  style="cursor:pointer;" class="text-center">
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
   $('form').ajaxForm({

      beforeSend:function(){

        $('#success').empty();

                <?php
$msg = null;
$type = \App\Type::where('id',$id)->first();
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
} function getvideo(c){
		  var output = document.getElementById(`kt${c}`);
		var $source = $(`#video_here${c}`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}function getvid(){
		  var output = document.getElementById(`kt`);
		var $source = $(`#video_here`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}
 /* $(document).on("change", ".url", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});*/
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

function getimage(f){
    var output = document.getElementById(`d${f}`);
    if (output.files && output.files[0]) {
        var reader = new FileReader();
        console.log(output);
        reader.onload = function (e) {
            $(`#r${f}`).attr('src', e.target.result);
        }

        reader.readAsDataURL(output.files[0]);
    }
}
function getboard(f){
    var output = document.getElementById(`real${f}`);
    if (output.files && output.files[0]) {
        var reader = new FileReader();
        console.log(output);
        reader.onload = function (e) {
            $(`#b${f}`).attr('src', e.target.result);
        }

        reader.readAsDataURL(output.files[0]);
    }
}
let c = 1;
$("#clicked").click(function(){
    $('.info').append(`<section id="s${c}">
        <div class="row">
                       <div class="col-6 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here${c}">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt${c}" type="file" onchange="getvideo(${c})"  class="form-control url ehabtalaat" name="url[]">
                            <label for="kt${c}" class="ahmed">اضافة فيديو</label>
                            @error('url')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div><div class="col-6 text-center set-img">
                            <canvas class="pdfViewer" style="width:200px;height:200px"></canvas>
                   <input id="myPdf${c}" type="file" class="form-control pdf ehabtalaat" name="pdf[]">
                   <br>
<br>
                            <label for="myPdf${c}" class="ahmed">اضافة pdf</label>
                            @error('pdf')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>
                           <div class="col-6 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="r${c}" class="realimg">
                    <br>
                   <input id="d${c}" type="file" class="form-control image ehabtalaat" onchange="getimage(${c})"  name="images[]">
                            <label for="d${c}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>

                            <div class="col-6 text-center set-img">
                                <img src="{{asset('images/set-img.svg')}}" id="b${c}"  class="realboard">
                                <br>
                               <input id="real${c}" type="file" onchange="getboard(${c})" class="form-control board ehabtalaat" name="boards[]">
                                        <label for="real${c}" class="ahmed">سبوره الحصه</label>
                                        @error('board')
                                        <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>

                            </div>
                            <div class="row mt-5 d-flex justify-content-center">
                                     <div class="form-group col-4">
                                  <input id="name_ar" type="text" class="form-control name_ar" name="names_ar[]"
                               placeholder="عنوان الفيديو بالعربى ">
                               </div>  <div class="form-group col-4">
                                  <input id="name_en" type="text" class="form-control name_en" name="names_en[]"
                               placeholder="عنوان الفيديو بالانجليزي ">
                               </div>
                               <div class="col-1"></div>
                           <div class="form-group p-0 col-3">
                               <label for="pay" class="paylabel">مدفوع</label>
                               <input class="pay" type="checkbox"  value="1" name="pay[]">
                               <br>

                           </div>
  <div class="form-group col-3">
                               <label>ترتيب الفيديو </label>
                               <input style="height: 36px;" min="0" type="number" name="order[]">
                               </div>
                           </div>
                           <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                   <label>الوصف بالعربى</label>
                                   <textarea class="description_ar form-control" rows="6" name="description_ar[]"></textarea>
                                </div>
                                <div class="col-4">
                                   <label>الوصف بالانجليزي</label>
                                   <textarea class="description_en form-control" rows="6" name="description_en[]"></textarea>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-3 h-25" style="transform: translateY(280%);">
                                   <button class="form-control btn btn-danger btn-sm" onclick="removesection(${c})"
                                    > حذف</button>
                                </div>
                           </div>




                          </section>`);
                            c++;
});
function removesection(c){
    $(`#s${c}`).remove();
    c--;
}

function readURL1(input) {
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
});
function writerURL1(input) {
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
})
</script>
  @endsection
