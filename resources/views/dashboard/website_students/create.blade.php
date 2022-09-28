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
                onchange="getsub(this)">
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
                <select name="sub_id" class="form-control" id="sub" required onchange="getlecturer(this)">
                  <option value="0" selected="selected" disabled>
                    اختر  كورس
                  </option>

                </select>
                @error('sub_id')
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
  $('form').ajaxForm({
    beforeSend: function() {
      $('#success').empty();
    },
    uploadProgress: function(event, position, total, percentComplete) {
      $('.progress-bar').text(percentComplete + '%');
      $('.progress-bar').css('width', percentComplete + '%');
    },
    success: function(data) {
      if (data.errors) {
        $('.progress-bar').text('0%');
        $('.progress-bar').css('width', '0%');
        $('#success').html('<span class="text-danger"><b>' + data.errors + '</b></span>');
      }
      if (data.success) {
        $('.progress-bar').text('Uploaded');
        $('.progress-bar').css('width', '100%');
        $('#success').html('<span class="text-success"><b>' + data.success + '</b></span><br /><br />');
        location.href = 'course';
      }
    }
  });

  function getyear(selected) {

    var id = selected.value;
    console.log(id);
    $.ajax({
      type: "GET",
      url: `getyear/${id}`, //put y
      contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result) {
        $('#subject').empty();
        $('#subject').html(result);

      }

    });
  }

  function getteacher(selected) {

    var id = selected.value;
    console.log(id);
    $.ajax({
      type: "GET",
      url: `getteacher/${id}`, //put y
      contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result) {
        $('#teacher').empty();
        $('#teacher').html(result);

      }

    });
  }

  function getcity(selected) {
    let id = selected.value;
    console.log(id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "get",
      url: `getcity/${id}`,
      //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result) {
        $('#city').empty();
        $('#city').html(result);
        console.log(result);
      }

    });
  }

  function getsub(selected) {
    let id = selected.value;
    console.log(id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "get",
      url: `getsub/${id}`,
      //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result) {
        $('#sub').empty();
        $('#sub').html(result);
        console.log(result);
      }

    });
  }

  function getlecturer(selected) {
    let id = selected.value;
    console.log(id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "get",
      url: `getlecturer/${id}`,
      //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result) {
        $('#lecturer').empty();
        $('#lecturer').html(result);
        console.log(result);
      }

    });
  }
  $(document).on("change", "#kt", function(evt) {
    var $source = $('#video_here');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#realimg').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#ad").change(function() {
    readURL(this);
  });
</script>
@endsection