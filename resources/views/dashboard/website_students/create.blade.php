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
          <h5>اضافه طالب لموقع </h5>
        </div>
        <form method="post" action="{{route('website_students.store')}}" enctype="multipart/form-data">
          @csrf
        
          <div class="info">
            <div class="row">
              <div class="form-group col-lg-3 col-md-6 col-12">
                <label> الاسم  </label>
                <input class="form-control" required type="text" name="name">
                @error('name')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group col-lg-3 col-md-6 col-12">
                <label>رقم الهاتف  </label>
                <input class="form-control" required type="number" name="phone">
                @error('phone')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group col-lg-3 col-md-6 col-12">
                <label> كلمه السر  </label>
                <input class="form-control" required type="number" name="password">
                @error('password')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group col-lg-3 col-md-6 col-12">
                <label> المحاضر</label>
                <select name="user_id" class="form-control" required 
                onchange="get_filter_user_courses(this)">
                  <option value="0" selected="selected" disabled>
                    اختر  مدرس
                  </option>
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
                @error('user_id')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group col-lg-3 col-md-6 col-12">
                <label> الكورسات</label>
                <select name="course_ids[]" class="form-control selectpicker" multiple id="sub" required onchange="getlecturer(this)">
                  <option value="0" selected="selected" disabled>
                    اختر  كورس
                  </option>

                </select>
                @error('course_ids')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
            

            </div>
          </div>
       

        

          <div>
      
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

function get_filter_user_courses(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../get_filter_user_courses/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#sub').empty();
       $('#sub').html(result.data);
       $("#sub").selectpicker("refresh");
       }

      });
    }

</script>
@endsection