@extends('App.dash')
@section('content')
<style>
		.studentprofile .img img{
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            width: 70%;
        }
		.studentprofile .qr img{
            margin: 0 auto;
            display: flex;
            width: 80%;
        }
		.studentprofile .qr a{
            margin: 5px auto;
            display: flex;
        }
        .studentprofile h4{
            display: flex;
            justify-content: center;
            margin: 5% 0 0;
        }
        .studentprofile h5{
            display: flex;
            justify-content: center;
            margin: 2% 0;
        }
        .studentprofile p{
            margin-right: 2%;
            margin-left: 2%;
        }
	.studentprofile .fl{
		margin-top: 5%;
		box-shadow: 0 5px 5px 5px #d5d5d573;
    	padding: 5%;
	}
	.studentprofile .qr{
		position: absolute;
		top: 15%;
	}
	.studentprofile .img{
		position: absolute;
		top: 15%;
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

<?php 
	$lecturer = \App\User::where('id',$id)->first();			
			 $usersub = \App\Sub_User::where('user_id',$lecturer->id)->pluck('sub_id')->toArray();
                      $subs = \App\Sub::whereIn('id',$usersub)->get();
				?>
                <!--start setting-->
                <div class="col-12 studentprofile">
	<div class="row fl bg-white">
        <div class="col-3">
            <div class="img">
                <img src="{{asset('uploads/'.$lecturer->image)}}">
                <h4>{{$lecturer->name}}</h4>
                <h5>{{$lecturer->code}}</h5>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <h6>الايميل:</h6>
                <p>{{$lecturer->email}}</p>
            </div>
			<div class="row">
                <h6>التليفون:</h6>
                <p>{{$lecturer->phone}}</p>
            </div>
            <div class="row">
                <h6>المحافظة:</h6>
				@if($lecturer->state)
                <p>{{$lecturer->state['state']}}</p>
				@endif
            </div>
            <div class="row">
                <h6>المدينة:</h6>
                @if($lecturer->city)
                <p>{{$lecturer->city['city']}}</p>
				@endif
            </div>
            <div class="row">
                <h6>العنوان:</h6>
                <p>{{$lecturer->address}} </p>
            </div>
            <div class="row">
                <h6>عدد الكورسات:</h6>
                <p>{{count($lecturer->courses)}}</p>
            </div>
			<div class="row">
                <h6 for="year">القسم الرئيسى :</h6>
                <p>{{$lecturer->general['name_ar']}}</p>
            </div>
			<div class="row">
                <h6 for="year">القسم الفرعى :</h6>
				@if($subs)
                <p> {{implode('-',$subs->pluck('name_ar')->toArray())}}</p>
				@endif
            </div>
	
            <div class="row">
                <h6>الوصف:</h6>
                <p>{{$lecturer->description}}</p>
            </div>
        </div>
		 <div class="col-3">
            <div class="qr">
            	@if($lecturer->code)
							{!! QrCode::size(80)->backgroundColor(255,255,204)->generate($lecturer->code) !!}
						@else 
					
							لايوجد كود  للمحاضر
					@endif
								  	
            </div>
        </div>
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
@endsection
