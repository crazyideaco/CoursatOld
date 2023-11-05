@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start !important;
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
                            <h5>المدن</h5>

                        </div>
                        <form method="post" action="{{route('updatecity',$city->id)}}">
                            @csrf
                        
                        <div class="row mt-4">
                            <div class="col-2"></div>
                            <div class="col-4 form-group">
                            <select class="selectpicker  qeno-select form-control"  name="state_id"
                            data-live-search="true">
                                 @foreach($states as $state)
                                <option value="{{$state->id}}" @if($city->state_id == $state->id) selected @endif>{{$state->state}}</option>
                                @endforeach
                            </select>
                            <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                                    </div>
                            <div class="col-4">
                                <input type="text" class="form-control" value="{{$city->city}}" name="city" placeholder="المدينه" id="city">
                                <div id="alert"></div>
                            </div> 
                        </div>

                        <div class="row add">
                            <div class="col-12 text-center">
                                <button class="btn" id="btn" onclick="addcity()">
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