@extends('App.dash')
@section('content')
<style>
.info .bootstrap-select button {
    width: 100%;
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
                            <h5>اضافه امتحان </h5>
                        </div>
                       <form method="post" action="{{route('storecourseexam',$id)}}" enctype="multipart/form-data">
                        	@csrf
                            <section id="section">
                        <div class="info">   
                       
                          <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                              <label>الاسم</label>
                              <input type="text" name="name_ar" class="form-control" >
                            </div> <div class="col-lg-4 col-md-6 col-12">
                              <label>عدد الاسئله</label>
                              <input type="number" name="question_number" class="form-control" >
                            </div>
                             <!--  <div class="col-1">
                              <label>تاريخ </label>
                              <input type="radio" name="duration" value="0" onchange="display2()"   >
                            </div>-->
                               <div id="his" class="row col-lg-6 col-md-6 col-12 p-0">
                            
                            <div class="col-lg-6 col-md-6 col-12">
                              <label>التاريخ</label>
                              <input type="date" name="date_day" class="form-control" >
                            </div>
                             
                         
                              
                            
                            <div class="col-lg-6 col-md-6 col-12">
                              <label>ساعه البدء</label>
                              <input type="time" name="date_time" class="form-control" >
                            </div>
                                 
                            </div>
                            
                          <!--   <div class="col-1">
                              <label>مده </label>
                              <input type="radio" name="duration" value="0" onchange="display()" checked  >
                            </div>-->
                              
                             <div class="col-lg-4 col-md-6 col-12" style="display:block;" id="dur">
                              <label> المده بالدقائق</label>
                              <input type="number" name="duration_time" class="form-control" >
                            </div>
                            <div class="col-lg-2 col-md-6 col-12">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="totalscore">
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col-lg-4 col-md-4 col-12">
                              <span class="btn btn-success w-100 my-2 text-white" id="click">
                              اضافه سؤال
                              </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                              <span class="btn btn-primary w-100 my-2 text-white" onclick="addquestion()">
                                بنك الاسئله العام 
                              </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                              <span class="btn btn-danger w-100 my-2 pl-3 text-white" onclick="addquestion3()">
                                بنك الاسئله الخاص 
                              </span>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <input type="text" class="form-control" name="name[0]">
                            </div>
                                   <div class="col-lg-4 col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg" style="width:60%;height:300px;">
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
    console.log($box.attr("class"));
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
}); 
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
          location.href =`../courseexams/${data.id}`;
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
}
  let id = 1;
  $("#click").click(function(){
    $("#section").append(` 
     <div id="s${id}"><div class="info">
                             <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <input type="text" class="form-control" name="name[${id}]">
                            </div>
                                   <div class="col-lg-4 col-12 text-center">
                               <img src="{{asset('images/set-img.svg')}}" id="r${id}" style="width:60%;height:300px;">
                    <br>
                   <input id="d${id}" type="file" class="form-control ehabtalaat" onchange="getimage(${id})" name="question_image[${id}]">
                            <label for="d${id}" class="ahmed">اضافة صوره</label>
                            @error('image')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                          </div>
   <div class="row">
                            
                          
                            <div class="col-lg-2 col-6">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[${id}]">
                            </div>
                            <div class="col-lg-3 col-6">
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
                              <input type="checkbox" class="form-control" name="correct[${id}][0]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[${id}][1]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][1]" value="0">
                              <input type="checkbox" class="form-control" name="correct[${id}][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[${id}][2]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][2]" value="0">
                              <input type="checkbox" class="form-control" name="correct[${id}][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-lg-6 col-8">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[${id}][3]" required>
                            </div>
                            <div class="col-lg-1 col-4">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][3]" value="0">
                              <input type="checkbox" class="form-control" name="correct[${id}][3]" value="1">
                            </div>
                          </div>
                          <div class="row">
                                <div class="col-lg-6 col-12">
                           <img src="{{asset('remove.png')}}" style="width:40px;height:40px;cursor:pointer;" id="click" class="mt-4" onclick="removequestion(${id})">
                            </div>
                          </div>
                          	
                            </div> 
</div> 
                          	   `);
                            id++;
});
  function removequestion(id){
    $(`#s${id}`).remove();
    id--;
} function display(){
  $("#dur").toggle();
  $("#his").toggle();
}function display2(){
  $("#dur").toggle();
  $("#his").toggle();
}
  let id2 =100
  function addquestion(){
    $("#section").append(`
<div class="row info mt-4 mb-4" id="q${id2}">
  <div class="col-8">
  <select class="form-control selectpicker mt-4" data-live-search="true" name="question_id[]">
  @foreach($questions as $question)
<option value="{{$question->id}}"> {{$question->name}}</option>
@endforeach
  </select></div>
         <div class="col-4">
                             
                           <img src="{{asset('remove.png')}}" style="width:40px;height:40px;cursor:pointer;" class="mt-4" onclick="removequestion2(${id2})">
                            </div>
  </div>`);
    $(".selectpicker").selectpicker("refresh");
    id2++;
  }  function removequestion2(id2){
    $(`#q${id2}`).remove();
    id2--;
} 
  let id3 =300;
  function addquestion3(){
    $("#section").append(`
<div class="row info mt-4 mb-4" id="u${id3}">
  <div class="col-8">
  <select class="form-control selectpicker mt-4" data-live-search="true"  name="question_id[]">
  @foreach($privatequestions as $question)
<option value="{{$question->id}}"> {{$question->name}}</option>
@endforeach
  </select></div>
         <div class="col-4">
                             
                           <img src="{{asset('remove.png')}}" style="width:40px;height:40px;cursor:pointer;"  class="mt-4" onclick="removequestion3(${id3})">
                            </div>
  </div>`);
    $(".selectpicker").selectpicker("refresh");
    id3++;
  }  function removequestion3(id2){
    $(`#u${id3}`).remove();
    id3--;
}
</script>
  @endsection