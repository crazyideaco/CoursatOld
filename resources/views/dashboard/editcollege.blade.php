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
                            <h5>تعديل كليه </h5>
                        </div>
                            <form method="post" action="{{route('updatecollege',$college->id)}}" enctype="multipart/form-data">
                        	@csrf
                         
                                    
                                <div class="row">
                                <div class="col-12 text-center set-img">
                               <img src="{{asset('uploads/'.$college->image)}}" id="realimg">
                    <br>
                               <input id="ad" type="file" class="form-control ehabtalaat"  name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                 @error('image')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                           </div>

                            </div>
                        </div>
                        <div class="info">
                            <div class="row">
                                  <div class="form-group col-lg-4 col-12">
                                     
                              <label> اختر جامعه</label><br >
                               <select  name="university_id" class="form-control">
                                    <option value="0" selected="selected" disabled="disabled">اختر جامعه</option>
                                       @foreach($universities as $university)
                                       <option value="{{$university->id}}" 
                                       @if($college->university_id == $university->id) selected @endif
                                       >{{$university->name_ar}}</option>
                                        @endforeach                                   
                                   </select>
									   @error('university_id')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                                   <script>
                                // $(function () {
                                //     $('.selectpicker').selectpicker();
                                // });
                                        </script>
                               </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label>اسم الكليه بالعربى</label>
                                    <input class="form-control" type="text" name="name_ar" value="{{$college->name_ar}}">
									 @error('name_ar')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                                </div>
                                 <div class="form-group col-lg-4 col-12">
                                    <label>اسم الكليه بالانجليزي</label>
                                    <input class="form-control" type="text" name="name_en" value="{{$college->name_en}}">
									  @error('name_en')
                                 <p style="color:red;">{{$message}}</p>
                                 @enderror
                                </div>
                                <input type="hidden" name="category_id" value="2">
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
 function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad").change(function(){
    readURL(this);
});

</script>
@endsection