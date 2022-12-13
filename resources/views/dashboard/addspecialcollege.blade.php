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
                            <h5>اضافه حصه مخصصه </h5>
                        </div>
                            <form method="post" action="{{route('storespecialcollege',$id)}}" enctype="multipart/form-data">
                        	@csrf
                        	  
                            <div class="row">
                           <div class="col-12 text-center set-img">
                         <input id="ad" type="file" class="form-control ehabtalaat" required name="image">
                           <img src="{{asset('images/set-img.svg')}}" id="realimg">
                                <br>
                            <label for="ad" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <div class="alert alert-danger">هذا الحقل مطلوب</div>
                            @enderror
                           </div>
                            </div>
                           @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                        <div class="info">
                            <div class="row">
                                  <div class="col-3 form-group">
                                        <label>عنوان الحصه بالعربى</label>
                               <input id="name" type="text" class="form-control"  required name="name_ar" value="{{old('name_ar')}}"
                               placeholder="الاسم">
                                      @error('name_ar')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror
                                       </div>
                                       <div class="col-3 form-group">
                                        <label>عنوان الحصه بالانجليزي</label>
                               <input id="name" type="text" class="form-control" required name="name_en" value="{{old('name_en')}}"
                               placeholder="الاسم">
                                      @error('name_en')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror  
                                       </div>
                                  
                        
                                   <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="    height: 36px;" type="number" required name="points" value="{{old('points')}}">
                               </div>
                              
                               
                            </div>
                          
                           @elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2)
                        </div>
                             <div class="info">
                            <div class="row">
                                  <div class="col-3 form-group">
                                        <label>عنوان الحصه بالعربى</label>
                               <input id="name" type="text" class="form-control" required name="name_ar" value="{{old('name_ar')}}"
                               placeholder="الاسم">
                                      @error('name_ar')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror
                                       </div>
                                       <div class="col-3 form-group">
                                        <label>عنوان الحصه بالانجليزي</label>
                               <input id="name" type="text" class="form-control" required name="name_en" value="{{old('name_en')}}"
                               placeholder="الاسم">
                                      @error('name_en')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror  
                                       </div>
                                  
                               
                         
                                   <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="    height: 36px;" type="number" name="points" value="{{old('points')}}">
                               </div>
                               
                            </div>
                           
                          @elseif(Auth::user() &&Auth::user()->is_student == 3)
                
           


                            


                        </div>
                      <div class="info">
                            <div class="row">
                                  <div class="col-3 form-group">
                                        <label>عنوان الحصه بالعربى</label>
                               <input id="name" type="text" class="form-control" required name="name_ar" value="{{old('name_ar')}}"
                               placeholder="الاسم">
                                      @error('name_ar')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror
                                       </div>
                                       <div class="col-3 form-group">
                                        <label>عنوان الحصه بالانجليزي</label>
                               <input id="name" type="text" class="form-control" required name="name_en" value="{{old('name_en')}}"
                               placeholder="الاسم">
                                      @error('name_en')
                                      <p style="color:red;">{{$message}}</p>
                                      @enderror  
                                       </div>
                                  
                              
                                     
                              
                                
                                   <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="    height: 36px;" required type="number" name="points" value="{{old('points')}}">
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
                                     <option value="{{$video->id}}">{{$video->name_ar}} </option>
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
       <div class="row">
                               <div class="form-group col-md-6 col-12">
                                   <label>الوصف</label>
                                   <textarea class="form-control"
                                    rows="5" id="description" 
                                    name="description"></textarea>
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
      var id = 1;
  $('#adds').click(function(){
    console.log(id);
    $("#section").append(`
    <div class="row col-12" 
    id='pre${id}'>
    <div class="form-group col-5">
                                    <label>اسم الفيديو </label>
                                   <select name="video_id[]" class="form-control selectpicker"  required  >
                                       <option value="0" disabled="disabled" selected="selected"> اختر فيديو</option>
                                    @foreach($videos as $video)
                                     <option value="{{$video->id}}">{{$video->name_ar}} </option>
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
}  function getdocsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdocsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  }
   function getdocsubcollege(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdocsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  }function getdoctypescollege(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdoctypescollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#typescollege').empty();
    $('#typescollege').html(result);
       }

      });
  }
  function getsubdocvideo(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `../getsubdocvideo/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#doctor').empty();
        $('#doctor').html(result.doctor);
           $('#doctor').selectpicker("refresh");
        $("#video").empty();
        $('#video').html(result.video);
            $('#video').selectpicker("refresh");
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
 function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdivision/${id}`,
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
       url: `../getsection/${id}`,
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
       url: `../getsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  }
   function gettypescollege2(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../gettypescollege2/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           console.log(result);
     $('#typescollege').empty();
    $('#typescollege').html(result[0]);
     $('#doctor').empty();
    $('#doctor').html(result[1]);
          $('#doctor').selectpicker("refresh");
       }

      });
  }
   function getlesson(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getlesson/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           console.log(result);
     $('#lesson').empty();
    $('#lesson').html(result);
       }

      });
  } function getvideosc(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getvideosc/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           console.log(result);
     $('#video').empty();
    $('#video').html(result.data);
          $('#video').selectpicker("refresh");
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
    // Loaded via <script> tag, create shortcut to access PDF.js exports.

  $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
}); function getcollege(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       $('#college').selectpicker('refresh');
      
       }

      });
    }

</script>
  @endsection