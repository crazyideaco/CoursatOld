@extends('App.dash')
@section('content')
    <style>
        .studentprofile img {
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            width: 70%;
        }

        .studentprofile h4 {
            display: flex;
            justify-content: center;
            margin: 5% 0 0;
        }

        .studentprofile h5 {
            display: flex;
            justify-content: center;
            margin: 2% 0;
        }

        .studentprofile p {
            margin-right: 2%;
            margin-left: 2%;
        }

        .studentprofile .fl {
            margin-top: 5%;
            box-shadow: 0 5px 5px 5px #d5d5d573;
            padding: 5%;
        }

        .studentprofile .img {
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
                                <img src="{{ asset('images/profile.svg') }}">
                            </div>
                            <div class="col-6">
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>ادمن</p>

                            </div>


                        </div>
                    </div>
                    <div class="flag">

                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('images/flag.svg') }}">
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
                            <p>{{ Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        </div>
                    </div>


                </div>


            </div>
            <!--end heed-->

            <?php
            $student = \App\User::where('id', $id)->first();
            ?>
            <!--start setting-->
            <div class="col-12 studentprofile">
                <div class="row fl bg-white">
                    <div class="col-3">
                        <div class="img">
                            @if ($student->image)
                                <img src="{{ url('uploads/' . $student->image) }}">
                            @endif
                            <p> {{ $student->name }}</p>
                            <p> {{ $student->code }}</p>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <h6>الايميل:</h6>
                            <p>{{ $student->email }}</p>
                        </div>
                        <div class="row">
                            <h6>التليفون:</h6>
                            <p>{{ $student->phone }}</p>
                        </div>
                        <div class="row">
                            <h6>نوع الهاتف:</h6>
                            <p>{{ $student->device_id }}</p>
                        </div>
                        @if ($student->category_id == 1)
                            <div class="row">
                                <h6 for="year">السنة:</h6>
                                <p>
                                    @if ($student->year)
                                        {{ $student->year->year_ar }}
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <h6 for="year">المرحله:</h6>
                                <p>
                                    @if ($student->stage)
                                        {{ $student->stage['stage_ar'] }}
                                    @endif
                                </p>
                            </div>
                        @endif
                        @if ($student->category_id == 2)
                            <div class="row">
                                <h6 for="year">الجامعه:</h6>
                                @if ($student->university)
                                    <p>{{ $student->university['name_ar'] }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <h6 for="year">الكليه:</h6>
                                @if ($student->college)
                                    <p>{{ $student->college['name_ar'] }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <h6 for="year">السنه:</h6>
                                @if ($student->division)
                                    <p>{{ $student->division['name_ar'] }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <h6 for="year">الفرقه:</h6>
                                @if ($student->section)
                                    <p>{{ $student->section['name_ar'] }}</p>
                                @endif
                            </div>
                        @endif
                        <div class="row">
                            <h6>المحافظة:</h6>
                            @if ($student->state)
                                <p>{{ $student->state['state'] }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <h6>المدينة:</h6>
                            @if ($student->city)
                                <p>{{ $student->city['city'] }}</p>
                            @endif
                        </div>

                        <div class="row">
                            <h6>النقاط:</h6>
                            <p>{{ $student->points }}</p>
                        </div>
                        <div class="row">
                            <h6>الوصف:</h6>
                            <p>{{ $student->description }} </p>
                        </div>
                        @if ($student->category_id == 1)
                            <div class="row">
                                <h6>عدد الكورسات:</h6>
                                <p>{{ count($student->stutypes) }} </p>
                            </div>
                            <div class="row">
                                <h6>الكورسات :</h6>
                                <p>
                                    @if ($student->stutypes)
                                        {{ implode('-', $student->stutypes->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <h6>المجموعات :</h6>
                                <p>
                                    @if ($student->groupstype)
                                        {{ implode('-', $student->groupstype->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                        @elseif($student->category_id == 2)
                            <div class="row">
                                <h6>عدد الكورسات:</h6>
                                <p>{{ count($student->stutypescollege) }} </p>
                            </div>
                            <div class="row">
                                <h6>الكورسات :</h6>
                                <p>
                                    @if ($student->stutypescollege)
                                        {{ implode('-', $student->stutypescollege->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <h6>المجموعات :</h6>
                                <p>
                                    @if ($student->groupstype)
                                        {{ implode('-', $student->groupstypescollege->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                        @elseif($student->category_id == 3)
                            <div class="row">
                                <h6>عدد الكورسات:</h6>
                                <p>{{ count($student->stucourses) }} </p>
                            </div>
                            <div class="row">
                                <h6>الكورسات :</h6>
                                <p>
                                    @if ($student->stutypescollege)
                                        {{ implode('-', $student->stucourses->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <h6>المجموعات :</h6>
                                <p>
                                    @if ($student->groupstype)
                                        {{ implode('-', $student->groupscourse->pluck('name_ar')->toArray()) }}
                                    @endif
                                </p>
                            </div>
                        @endif

                        <div class="row">
                            <h6 for="year">تابع الى :</h6>
                            @if ($student->stdcenters)
                                <p>
                                    {{ implode('-', $student->stdcenters->pluck('name')->toArray()) }}
                                </p>
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
                    <h5>Made With <img src="{{ asset('images/red.svg') }}"> By Crazy Idea </h5>
                    <p>Think Out Of The Box</p>
                </div>
            </div>
        </div>
        <!--end foter-->
    </div>
@endsection
