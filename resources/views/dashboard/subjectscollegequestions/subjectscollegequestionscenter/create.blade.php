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
                            <h5>اضافه سؤال </h5>
                        </div>
                       <form method="post" action="{{route('storesubjectscollegequestionscenter')}}" enctype="multipart/form-data">
                        	@csrf
                                @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                            <div class="row">
                                    <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" onchange="getcolleges(this)">
                                       <option value="null" >اختر جامعه</option>
                                       @foreach($universities as $university)
                                       <option value="{{$university->id}}">
                                           {{$university->name_ar}}
                                           </option>
                                       @endforeach
                                   </select>
                                    @error('university_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="null" >اختر كليه</option>
                                       @foreach($colleges as $college)
                                       <option value="{{$college->id}}">{{$college->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="null" >اختر قسم</option>
                                       @foreach($divisions as $division)
                                       <option value="{{$division->id}}">{{$division->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section1" onchange="getsubcollege(this)" >
                                       <option value="null"  >اختر فرقه</option>
                                       @foreach($sections as $section)
                                       <option value="{{$section->id}}">{{$section->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" onchange="getdoctor(this)" >
                                       <option value="null" >اختر ماده</option>
                                       @foreach($subcolleges as $subcollege)
                                       <option value="{{$subcollege->id}}">{{$subcollege->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>

                           <!--      <div class="form-group col-3">
                                 <label>اختر الدكتور</label>
                      <select name="doctor_id" class="form-control" required  id="doctor">
                          <option value="0"  >اختر الدكتور</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                           </div>  -->
                         </div>
                           @elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2)
                            <div class="row">

                                    <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" onchange="getcolleges(this)">
                                       <option value="null"  >اختر جامعه</option>
                                       @foreach($universities as $university)
                                       <option value="{{$university->id}}">
                                           {{$university->name_ar}}
                                           </option>
                                       @endforeach
                                   </select>
                                    @error('university_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control"  id="college" onchange="getdivision(this)">
                                       <option value="null" >اختر كليه</option>
                                       @foreach($colleges as $college)
                                       <option value="{{$college->id}}">{{$college->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="null"  >اختر فرقه</option>
                                       @foreach($divisions as $division)
                                       <option value="{{$division->id}}">{{$division->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getsubcollege(this)" >
                                       <option value="null" >اختر قسم</option>
                                       @foreach($sections as $section)
                                       <option value="{{$section->id}}">{{$section->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege"  onchange="getdoctor(this)" >
                                       <option value="0"  >اختر ماده</option>
                                       @foreach($subcolleges as $subcollege)
                                       <option value="{{$subcollege->id}}">{{$subcollege->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>

                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                 <label>اختار الدكتور</label>
                      <select name="doctor_id" class="form-control"  required id="doctor">
                          <option value="0"  >اختر الدكتور</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                           </div>
                         </div>
                            @elseif(Auth::user() &&Auth::user()->is_student == 3)
                              <div class="row">

                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getdocsection(this)">
                                       <option value="null"  >اختر قسم</option>
                                       @foreach($divisions as $division)
                                       <option value="{{$division->id}}">{{$division->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getdocsubcollege(this)" >
                                       <option value="null"  >اختر فرقه</option>
                                       @foreach($sections as $section)
                                       <option value="{{$section->id}}">{{$section->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" >
                                       <option value="null"  >اختر ماده</option>
                                       @foreach($subcolleges as $subcollege)
                                       <option value="{{$subcollege->id}}">{{$subcollege->name_ar}}</option>
                                       @endforeach
                                   </select>
                                </div>
                         </div>
                         @endif

                         <div class="row mt-4">


 <div class=" col-lg-3 col-md-6 col-12">
   <label>القسم</label>
   <input type="text" class="form-control w-100" name="part">
                          </div>
                         </div>
                         <section id="section">
                        <div class="info">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              {{--  <input type="text" class="form-control" name="name[0]">  --}}

                              <textarea  class="form-control" rows="6" name="name[0]"></textarea>
                            </div>
                                   <div class="col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg" class="my-3" style="width:60%;height:300px;">
                    <br>
                   <input id="ad" type="file" class="form-control ehabtalaat"  name="question_image[0]" style="width:50px;height:50px;">
                            <label for="ad" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                          </div>

                          <div class="row">


                            <div class="col-lg-2 col-6">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[0]">
                            </div>
                            <div class="col-lg-3 col-6">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[0]">

                              @for($i = 1;$i < 10; $i++)
                               <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                            </select>
                          </div>
                          </div>
                   <div class="row">
                            <div class="col-lg-6 col-8">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[0][0]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][0]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][0]" value="1" >
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[0][1]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][1]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[0][2]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][2]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[0][3]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][3]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][3]" value="1">
                            </div>
                          </div>
                          <div class="row">

                            <div class="col-lg-3 col-md-6 col-12">
                              <label>الشرح</label>
                              <textarea rows="5" class="form-control" name="notes[0]"></textarea>
                            </div>
                               <div class="col-lg-3 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt" type="file" class="form-control ehabtalaat"  name="video[0]">
                            <label for="kt" class="ahmed">اضافة فيديو</label>
                            @error('url')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                           <div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg2">
                    <br>
                   <input id="ad2" type="file" class="form-control ehabtalaat"  name="image[0]">
                            <label for="ad2" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>
                              <div class="col-lg-3 col-md-6 col-12 d-flex align-items-center">

                           <img src="{{asset('plus.png')}}" style="width:40px;height:40px;cursor:pointer;margin:20px auto;display:block;" id="click" >
                            </div>
                          </div>

                           </section>
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
  $("body").on('click','input:checkbox', function() {
    console.log("sasa");
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {

    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[class='" + $box.attr("class") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
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

  $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});   $('form').ajaxForm({
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
          location.href =`subjectscollegequestionscenter`;
        }
      }
    });function getvideo(c){
		  var output = document.getElementById(`kt${c}`);
		var $source = $(`#video_here${c}`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}
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
}let id = 1;
  $("#click").click(function(){
    console.log("adsds");
    $("#section").append(`
      <div class="info" id="s${id}">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <textarea  class="form-control" rows="6" name="name[${id}]"></textarea>
                            </div>
                                   <div class="col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="r${id}" class="my-3" style="width:60%;height:300px;">
                    <br>
                   <input id="d${id}" type="file" class="form-control ehabtalaat" onchange="getimage(${id})" name="question_image[${id}]">
                            <label for="d${id}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                          </div>

                          <div class="row">


                            <div class="col-lg-2 col-12">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[${id}]">
                            </div>
                            <div class="col-lg-3 col-12">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[${id}]">

                              @for($i = 1;$i < 10; $i++)
                               <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                            </select>
                          </div>
                          </div>
                   <div class="row">
                            <div class="col-lg-6 col-8">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[${id}][0]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][0]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][0]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[${id}][1]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][1]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[${id}][2]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][2]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[${id}][3]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][3]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][3]" value="1">
                            </div>
                          </div>
                          <div class="row">

                            <div class="col-lg-3 col-md-6 col-12 ">
                              <label>الشرح</label>
                              <textarea rows="5" class="form-control" name="notes[${id}]"></textarea>
                            </div>
                               <div class="col-lg-3 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
                       <source src="" id="video_here${id}">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt${id}" type="file" class="form-control ehabtalaat" onchange="getvideo(${id})"  name="video[${id}]">
                            <label for="kt${id}" class="ahmed">اضافة فيديو</label>
                            @error('url')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                           <div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="b${id}">
                    <br>
                   <input id="real${id}" type="file" class="form-control ehabtalaat" onchange="getboard(${id})" name="image[${id}]">
                            <label for="real${id}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>
                              <div class="col-lg-3 col-md-6 col-12 d-flex align-items-center">

                        <img src="{{asset('remove.png')}}" style="width:40px;height:40px;cursor:pointer;margin:20px auto;display:block;"  onclick="removequestion(${id})">
                            </div>
                          </div>

                          	   `);
                            id++;
});
   function removequestion(id){
    $(`#s${id}`).remove();
    id--;
} function getdivision(selected){
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
     $('#section1').empty();
    $('#section1').html(result);
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
  }
  function getdocsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdocsection/${id}`,
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
       url: `getdocsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  } function getdoctor(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdoctor/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#doctore').empty();
    $('#doctor').html(result);
       }

      });
  }
  function getcolleges(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       console.log(result);
       }

      });
    }
</script>
  @endsection
