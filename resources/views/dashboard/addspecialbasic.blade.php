@extends('App.dash')
@section('content')
<style>
span.btn{
 color: #fff !important;
    font-size: 16px;
    padding: 1% 6%
}
</style>
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
                            <h5>اضافه حصص مخصصه </h5>
                        </div>
                            <form method="post" action="{{route('storespecialbasic',$id)}}" enctype="multipart/form-data">
                        	@csrf
                            <div class="row">
                           <div class="col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg">
                    <br>
                   <input id="ad" type="file" class="form-control ehabtalaat" name="image">
                            <label for="ad" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                   </div>
                        </div>
                        <div class="info">
                            @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                            <div class="row">
                                     <div class="form-group col-4">
                                  <input id="name_ar" type="text" required="required" class="form-control" value="{{old('name_ar')}}" name="name_ar"
                               placeholder="عنوان الحصه بالعربى ">
                               </div> 
                               <div class="form-group col-4">
                                  <input id="name_en" type="text" required="required" class="form-control" value="{{old('name_en')}}" name="name_en"
                               placeholder="عنوان الحصه بالانجليزي ">
                               </div>
                  
                     
                       <div class="form-group col-4"> 
                                  <input id="points" type="number" class="form-control" required name="points" value="{{old('points')}}"
                               placeholder="النقاط">
                               </div>
                            </div>
                             @elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1)
                             <div class="row">
                                     <div class="form-group col-4">
                                  <input id="name_ar" type="text" required="required" class="form-control" name="name_ar" value="{{old('name_ar')}}"
                               placeholder="عنوان الحصه بالعربى ">
                               </div> 
                               <div class="form-group col-4">
                                  <input id="name_en" type="text" required="required" class="form-control" name="name_en" value="{{old('name_en')}}"
                               placeholder="عنوان الحصه بالانجليزي ">
                               </div>
                               
                       <div class="form-group col-4">
                                  <input id="points" type="number" class="form-control" required name="points" value="{{old('points')}}"
                               placeholder="النقاط">
                               </div>
                            </div>
                            @elseif(Auth::user() &&Auth::user()->is_student == 2)
                       <?php
                          $iduser=Auth::user()->id;
                       ?>
                    <div class="row">
                                     <div class="form-group col-4">
                                  <input id="name_ar" type="text" required="required" class="form-control" name="name_ar" value="{{old('name_ar')}}"
                               placeholder="عنوان الحصه بالعربى ">
                               </div> 
                               <div class="form-group col-4">
                                  <input id="name_en" type="text" required="required" class="form-control" name="name_en" value="{{old('name_en')}}"
                               placeholder="عنوان الحصه بالانجليزي ">
                               </div>
                              
                       <div class="form-group col-4">
                                  <input id="points" type="number" class="form-control" required name="points" value="{{old('points')}}"
                               placeholder="النقاط">
                               </div>
                            </div>
                        @endif
                      <section id="section">
       <div class="row">
      <div class="form-group col-5">
                                    <label>اسم الفيديو </label>
                                   <select name="video_id[]" class="form-control selectpicker"  required  >
                                       <option value="0" disabled="disabled" selected="selected"> اختر فيديو</option>
                                    @foreach($videos as $video)
                                     <option value="{{$video->id}}">{{$video->name_ar}} - {{$type->name_ar}}</option>
                                     @endforeach
                                   </select>
                                </div>
          <div class="col-3 form-group">
                                        <label>  الاسم</label>
                               <input id="name" type="text" class="form-control" required name="name[]" value="{{old('name')}}"
                               placeholder="الاسم">
                                      @error('name')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror
                                       </div>
           <div class="col-2">
         <div class="radio">
  <label><input type="radio" name="paid[0]" checked value="1"> مدفوع</label>
</div>
<div class="radio">
  <label><input type="radio" name="paid[0]" value="0"> مجانى</label>
</div>
           </div>
         <div class="col-2">
           
         
         <span id="adds" class="btn btn-success mt-4" >اضافه</span>
             </div>             </div>
       </section>
                  
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
        $(function () {
            $('.selectpicker').selectpicker();
        });
         </script>
<script>
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
        $('#type').empty();
        $('#type').html(result[1]);
       }
      });
}
// //get subtype
  function getsubtype(selected){
var id = selected.value;
 console.log(id);
  $.ajax({
      type:"GET",
      url: `../getsubtype/${id}`,//put y
      contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result){
          console.log(result);
        $('#subtype').empty();
        $('#subtype').html(result);
        
      }

      });
}
 function getvideos(selected){
var id = selected.value;
 console.log(id);
  $.ajax({
      type:"GET",
      url: `../getvideos/${id}`,//put y
      contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result){
          console.log(result);
        $('#video').empty();
        $('#video').html(result.data);
          $("#video").selectpicker('refresh');
      }
      });
}function getvideossub(selected){
var id = selected.value;
 console.log(id);
  $.ajax({
      type:"GET",
      url: `../getvideossub/${id}`,//put y
      contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result){
          console.log(result);
        $('#video').empty();
        $('#video').html(result.data);
        $("#video").selectpicker('refresh');
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
    
  let id = 1;
  $('#adds').click(function(){
    $("#section").append(` <div class="row col-12" id="pre${id}">
    <div class="form-group col-5">
                                    <label>اسم الفيديو </label>
                                   <select name="video_id[]" class="form-control selectpicker"  required  >
                                       <option value="0" disabled="disabled" selected="selected"> اختر فيديو</option>
                                    @foreach($videos as $video)
                                     <option value="{{$video->id}}">{{$video->name_ar}}</option>
                                     @endforeach
                                   </select>
                                </div>
    <div class="col-3 form-group">
                                        <label>  الاسم</label>
                               <input id="name" type="text" class="form-control" required name="name[]" value="{{old('name')}}"
                               placeholder="الاسم">
                                      @error('name')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror
                                       </div>
<div class="col-2">
        <div class="radio">
  <label><input type="radio" name="paid[${id}]" checked value="1"> مدفوع</label>
</div>
<div class="radio">
  <label><input type="radio" name="paid[${id}]" value="0"> مجانى</label>
</div>
           </div>
         <div class="col-2 mt-3">
           
         
         <span id="adds" class="btn btn-danger" onclick="removes(${id})">حذف</span>
             </div>   
</div>`);
    id++;
    $(".selectpicker").selectpicker();
});
function removes(id){
      $(`#pre${id}`).remove();
      id--;
    }
    
  $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});
</script>
  @endsection