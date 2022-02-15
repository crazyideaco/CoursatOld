@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
</style>
@endsection
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
                <div class="serv-place">
                    <div class="container">

                        <div class="row def">
                            <img src="{{asset('images/places.svg')}}">
                            <h5>السنوات</h5>

                        </div>


                        <form method="post" action="{{route('updateyears',$year->id)}}">
                            @csrf
                        <div class="row loc-add">
                            <div class="col-lg-3 col-md-6 col-12 mt-3">
                                <select class="form-control selectpicker" name="stage_id">
                                    <option value="0" disabled="disabled" selected="selected">ادخل مرحله</option>
                                    @foreach($stages as $stage)
                                    <option value="{{$stage->id}}"
                                    @if($year->stage_id == $stage->id) selected @endif>{{$stage->name_ar}}</option>
                                    @endforeach
                                </select>
                                @error('stage_id')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-3">
                                
     <input type="text"  value="{{$year->year_ar}}" class="form-control w-100" placeholder=" السنه بالعربى" name="year_ar"
                                >
                                @error('year_ar')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>
                                 
                            <div class="col-lg-3 col-md-6 col-12 mt-3">
                         <input type="text" value="{{$year->year_ar}}" class="form-control w-100" placeholder=" السنه بالانجليزي" name="year_en"
                                >
                                @error('year_en')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>
                          <div class="col-lg-3 col-md-6 col-12 mt-3">
                          		<label><input type="checkbox" @if($year->sandl == 1) checked @endif value="1" name="sandl">علمى وادبى</label>
                          </div>
                        </div>
                          
                        <div class="row add">
                            <div class="col-12 text-center">
                                <button class="btn" id="btn" type="submit">
                                    تعديل
                                    <span><i class="fas fa-download"></i></span>
                                    
                                </button>
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
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection