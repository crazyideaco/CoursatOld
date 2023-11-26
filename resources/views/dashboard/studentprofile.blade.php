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




        .details_student {
  background-color: #fff;
  border-radius: 10px;
  padding: 2rem;
}
.details_student img {
  display: block;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin: 0 auto;
}
.details_student .title {
  text-align: center;
  font-family: "semibold";
  color: #011c1e;
  margin-top: 1rem;
}
.details_student .text {
  font-family: "regular";
  color: #06797e;
  text-align: center;
}
.details_student .text-1 {
  font-family: "regular";
  color: #06797e;
  text-align: center;
  padding-bottom: 1rem;
  border-bottom: 1px solid #828c8d;
}
.details_student .details {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 100%;
  margin: 0 auto;
}
 .details_student .details .info.date {
  margin-inline-end: 0;
  width: fit-content;
}
.details_student .details .info {
  background-color: rgba(6,121,126,.1);
  font-family: "regular";
  color: #64666a;
  padding: 0.5rem;
  margin-bottom: 1rem;
  margin-inline-end: 1rem;
  width: 80%;
  font-size: .7rem;
  text-align: center;
  width: fit-content;
}
h5.title_section {
  font-family: 'bold';
}
svg.svg-inline--fa.fa-circle.online {
  color: green;
  margin: 0 auto;
  margin-inline-start: 8px;
}
svg.svg-inline--fa.fa-circle.ofline {
  color: rgb(175, 180, 175);
  margin: 0 auto;
  margin-inline-start: 8px;
}
p.text-online {
  display: block;
  margin: 0 auto;
  text-align: center;
  margin-top: 7px;
  color: black;
  font-family: 'regular';
  width: fit-content;
  padding: 0.1rem;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid;
  color: green;
}
.text-ofline {
  display: block;
  margin: 0 auto;
  text-align: center;
  margin-top: 7px;
  color: black;
  font-family: 'regular';
  width: fit-content;
  padding: 0.1rem;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid;
  color: rgb(103, 107, 103);

}
 .basic_information .title {
  font-family: "semibold";
  color: #011c1e;
  width: 100%;
}
 .basic_information {
  padding: 2.5rem;
  background-color: #fff;
  border: 1px solid #ebeaed;
  margin-bottom: 1.5rem;
  display: flex;
  flex-wrap: wrap;
  border-radius: 15px;
}
 .basic_information .info {
  width: 25%;
  text-align: start;
  font-size: .8rem;
  margin-top: 2rem;
}
.basic_information .info .text {
  font-family: "semibold";
  color: #909295;
  margin-bottom: 0;
}
.details_student .details .info svg {
  margin-inline-end: 10px;
}
span.number {
  color: red;
  font-family: bold;
}
.basic_information {
  background-color: white;
  padding: 0.5rem 0.5rem;
}
.table_details {
  background-color: white;
  margin-top: 13px;
  padding: 0.5rem 0.5rem;
}
 .table_details .nav-tabs .nav-link.active, .table_data .nav-tabs .nav-link.active {
  border-color: rgba(0,0,0,0);
  border-bottom: 2px solid #06797e;

}
button#exams-tab {
  color: black;
  font-family: 'regular';
}
button#coruses-tab {
  color: black;
  font-family: 'regular';
}
button#History-tab{
  color: black;
  font-family: 'regular';
}
.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
 border: unset;
  border-color:unset;
}
.header-table {
  display: flex;
  justify-content: space-between;
  margin-top: 15PX;
  align-items: center;
  font-family: "regular";
}
table.table {
  font-family: "regular";
  font-size: 0.8rem;
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
                    <div class="col-4">
                        <div class="details_student">
                            <img src="./photo/student.png" alt="group_img" />
                           <div class="online">

                            <p class="text-online">online<i class="fa-solid fa-circle online"></i></p>
                           </div>
                           <!-- ofline -->
                           <!-- <div class="ofline">
                            <p class="text-ofline">ofline<i class="fa-solid fa-circle ofline"></i></p>
                           </div> -->
                            <!-- ofline -->
                                        <h5 class="title">أحمد أمجد</h5>
                            <p class="text">أساسي</p>
                            <p class="text-1">عدد النقاط:<span class="number">25</span></p>
                            <div class="details">
                              <p class="info date">
                                <i class="fa-solid fa-calendar-days"></i>
                                تاريخ الانضمام : 22 مايو, 2023
                              </p>
                              <p class="info">
                                <i class="fa-solid fa-calendar-days"></i>
                                تاريخ اخر ظهور علي التطبيق : 24 مايو, 2024
                              </p>
                              <p class="info">
                                <i class="fa-solid fa-star"></i>
                                التقيم العام
                              </p>

                            </div>
                          </div>



                        {{-- <div class="img">
                            @if ($student->image)
                                <img src="{{ url('uploads/' . $student->image) }}">
                            @endif
                            <p> {{ $student->name }}</p>
                            <p> {{ $student->code }}</p>
                        </div> --}}
                    </div>
                    <div class="col-8">
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
