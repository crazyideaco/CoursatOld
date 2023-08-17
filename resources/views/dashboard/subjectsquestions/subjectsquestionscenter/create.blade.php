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
                       <form method="post" action="{{route('storesubjectquestionscenter')}}" enctype="multipart/form-data">
                        	@csrf
                             @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                         <div class="row">


                           <div class="form-group col-3">
                           <label>سنه الماده</label>
                            <select class="form-control" name="years_id" required id="year" onchange="getyear(this)">
                                <option value="0" selected="selected" disabled="disabled">اختر السنه</option>
                                @foreach($years as $year)
                                <option value='{{$year->id}}'>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                <div class="form-group col-3">
                           <label>الماده </label>
                            <select class="form-control" name="subjects_id" required id="subject" onchange="getteacher(this)">
                                  <option value="0" selected="selected" disabled="disabled">اختر الماده</option>
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}'>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
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
                           <label>سنه الماده</label>
                            <select class="form-control" name="years_id" id="year" required onchange="getyear(this)">
                                <option value="0" selected="selected" disabled="disabled">اختر السنه</option>
                                @foreach($yearr as $year)
                                <option value='{{$year->id}}'>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                <div class="form-group col-3">
                           <label>الماده </label>
                            <select class="form-control" name="subjects_id"  required id="subject" >
                                  <option value="0" selected="selected" disabled="disabled">اختر الماده</option>
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}'>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                         </div>
                                @elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1)
                      <div class="row">
                         <div class="form-group col-3">
                           <label>سنه الماده</label>
                            <select class="form-control" required name="years_id" id="year" onchange="getyear(this)">
                                <option value="0" selected="selected" disabled="disabled">اختر السنه</option>
                                @foreach($years as $year)
                                <option value='{{$year->id}}'>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                <div class="form-group col-3">
                           <label>الماده </label>
                            <select class="form-control" required name="subjects_id" id="subject" onchange="getteacher(this)">
                                  <option value="0" selected="selected" disabled="disabled">اختر الماده</option>
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}'>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>

                             <div class="form-group col-3">
                                    <label>اسم المدرس</label>
                      <select name="teacher_id" required class="form-control" id="teacher">
                          <option value="0" selected="selected" disabled>اختر المدرس</option>
                          @foreach(auth()->user()->teachers as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                            @error('teacher_id')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                         </div>
                         @endif
              <div class="row mt-4">

 <div class="col-6">
   <label>القسم</label>
   <input type="text" class="form-control" name="part">
                </div>
                          </div>
                         <section id="section">
                        <div class="info">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <textarea  class="form-control" rows="6" name="name[0]"></textarea>
                            </div>
                                   <div class="col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg" class="my-3" style="width:100%;height:500px;">
                    <br>
                   <input id="ad" type="file" class="form-control ehabtalaat"  name="question_image[0]" style="width:100%;height:500px;">
                            <label for="ad" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                          </div>

                          <div class="row">


                            <div class="col-2">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[0]">
                            </div>
                            <div class="col-3">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[0]">

                              @for($i = 1;$i < 10; $i++)
                               <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                            </select>
                          </div>
                          </div>
                   <div class="row">
                            <div class="col-6">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[0][0]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][0]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][0]" value="1" >
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[0][1]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][1]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[0][2]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][2]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[0][3]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[0][3]" value="0">
                              <input type="checkbox" class="hello" name="correct[0][3]" value="1">
                            </div>
                          </div>
                          <div class="row">

                            <div class="col-3">
                              <label>الشرح</label>
                              <textarea rows="13" class="form-control" name="notes[0]"></textarea>
                            </div>
                               <div class="col-3 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here">
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
                           <div class="col-3 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg2">
                    <br>
                   <input id="ad2" type="file" class="form-control ehabtalaat"  name="image[0]">
                            <label for="ad2" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>
                              <div class="col-3">

                           <img src="{{asset('plus.png')}}" style="width:40px;height:40px;cursor:pointer;margin-top:113px;" id="click" >
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
          location.href =`subjectquestionsscenter`;
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
    $("#section").append(`
      <div class="info" id="s${id}">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <textarea  class="form-control" rows="6" name="name[${id}]"></textarea>

                            </div>
                                   <div class="col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="r${id}" class="my-3" style="width:100%;height:500px;">
                    <br>
                   <input id="d${id}" type="file" class="form-control ehabtalaat" onchange="getimage(${id})" name="question_image[${id}]">
                            <label for="d${id}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                          </div>

                          <div class="row">


                            <div class="col-2">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[${id}]">
                            </div>
                            <div class="col-3">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[${id}]">

                              @for($i = 1;$i < 10; $i++)
                               <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                            </select>
                          </div>
                          </div>
                   <div class="row">
                            <div class="col-6">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[${id}][0]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][0]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][0]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[${id}][1]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][1]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[${id}][2]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][2]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[${id}][3]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][3]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][3]" value="1">
                            </div>
                          </div>
                          <div class="row">

                            <div class="col-3">
                              <label>الشرح</label>
                              <textarea rows="13" class="form-control" name="notes[${id}]"></textarea>
                            </div>
                               <div class="col-3 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
                       <source src="mov_bbb.mp4" id="video_here${id}">
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
                           <div class="col-3 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="b${id}">
                    <br>
                   <input id="real${id}" type="file" class="form-control ehabtalaat" onchange="getboard(${id})" name="image[${id}]">
                            <label for="real${id}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
               </div>
                              <div class="col-3">

                        <img src="{{asset('remove.png')}}" style="width:40px;height:40px;cursor:pointer;margin-top:113px;"  onclick="removequestion(${id})">
                            </div>
                          </div>

                          	   `);
                            id++;
});
   function removequestion(id){
    $(`#s${id}`).remove();
    id--;
}function getyear(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getyear/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#subject').empty();
    $('#subject').html(result);
       // $('#subject').selectpicker('refresh');
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
        $('#teacher').html(result[0]);

        $('#type').empty();
        $('#type').html(result[1]);
        $('#type').selectpicker('refresh');
       }

      });
}
</script>
  @endsection
