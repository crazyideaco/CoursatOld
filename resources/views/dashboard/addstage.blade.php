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
                            <h5>اضافه مرحله </h5>
                        </div>
                            <form method="post" action="{{route('storestage')}}" enctype="multipart/form-data">
                        	@csrf
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>اسم المرحله بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_ar" value="{{old('name_ar')}}">
                            @error('name_ar')
                            <div style="color:red;">{{$message}}  </div>
                            @enderror
                           </div>
                            <div class="form-group col-md-6 col-12">
                                    <label>اسم المرحله بالانجليزي</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " name="name_en" value="{{old('name_en')}}">
                            @error('name_en')
                            <div style="color:red;">{{$message}}  </div>
                            @enderror
                           </div>
                   <input type="hidden" name="category_id" value="1">
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

  @endsection