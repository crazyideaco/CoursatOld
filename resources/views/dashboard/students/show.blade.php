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
            background-color: #fafafa;
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
            font-family: "reg";
            color: #011c1e;
            margin-top: 1rem;
        }

        .details_student .text {
            font-family: "reg";
            color: #06797e;
            text-align: center;
        }

        .details_student .text-1 {
            font-family: "reg";
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
            background-color: rgba(6, 121, 126, .1);
            font-family: "reg";
            color: #64666a;
            padding: 0.5rem;
            margin-bottom: 1rem;

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
            margin-top: 4px;
        }

        svg.svg-inline--fa.fa-circle.ofline {
            color: rgb(175, 180, 175);
            margin: 0 auto;
            margin-inline-start: 8px;
            margin-top: 4px;
        }

        p.text-online {
            display: block;
            margin: 0 auto;
            text-align: center;
            margin-top: 7px;
            color: black;
            font-family: 'reg';
            width: fit-content;
            padding: 0.3rem;
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
            font-family: 'reg';
            width: fit-content;
            padding: 0.3rem;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid;
            color: rgb(103, 107, 103);

        }

        .basic_information .title {
            font-family: "reg";
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
            font-family: "reg";
            color: #909295;
            margin-bottom: 0
        }

        .details_student .details .info svg {
            margin-inline-end: 5px;
        }

        span.number {
            color: red;
            font-family: "reg";
        }

        .basic_information {
            background-color: white;
            padding: 0.5rem 0.5rem;
        }

        .table_details {
            background-color: white;
            margin-top: 13px;
            padding: 0.5rem 0.5rem;
            border-radius: 10px;
        }

        .table_details .nav-tabs .nav-link.active,
        .table_data .nav-tabs .nav-link.active {
            border-color: rgba(0, 0, 0, 0);
            border-bottom: 2px solid #06797e;

        }

        a#pills-exams-tab {
            color: black;
            font-family: 'reg';
        }

        a#pills-coruses-tab {
            color: black;
            font-family: 'reg';
        }

        a#pills-History-tab {
            color: black;
            font-family: 'reg';
        }

        a#pills-viwe-tab {
            color: black;
            font-family: 'reg';
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            border: unset;
            border-color: unset;
        }

        .header-table {
            display: flex;
            justify-content: space-between;
            margin-top: 15PX;
            /* align-items: center; */
            font-family: "reg";
        }

        table.table {
            font-family: "reg";
            font-size: 0.8rem;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #fafafa !important;
            color: black !important;
        }

        .table tbody tr td {
            color: black !important;
            color: black;
            padding: 0.5rem !important;
            font-family: "reg" !important;
            font-size: 0.9rem !important;
        }

        .basc {
            background-color: #fafafa;
            padding: 1rem;
            border-radius: 10px;
        }

        svg.svg-inline--fa.fa-trash-alt.fa-w-14.delet {
            color: red;
            cursor: pointer;
        }

        .name-cor {
            width: 100%;
        }

        .form-group.names {
            font-family: "reg";
        }

        button.btn.btn-success.names {
            margin: 0 auto;
            display: block;
            font-family: "reg";
            width: 100%;
        }

        .name-cor {
            width: 100%;
            background-color: #fafafa;
            margin-top: 15px;
            padding: 1rem;
            border-radius: 12px;
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
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="details_student">
                            @if ($student->image)
                                <img src="{{ url('uploads/' . $student->image) }}">
                            @endif
                            @if ($student->is_online == 1)
                                <div class="online">
                                    <p class="text-online">{{ $student->online_status }}<i class="fas fa-circle online"></i>
                                    </p>
                                </div>
                            @else
                                <!-- ofline -->
                                <div class="ofline">
                                    <p class="text-ofline">{{ $student->online_status }}<i
                                            class="fa-solid fa-circle ofline"></i></p>
                                </div>
                                <!-- ofline -->
                            @endif

                            <h5 class="title"> {{ $student->name }}</h5>
                            <p class="text">
                                {{ $student->category_id == config('project_types.system_category_type.category_id_basic') ? 'أساسي' : 'جامعي' }}
                            </p>
                            <p class="text-1">عدد النقاط:<span class="number">{{ $student->points }}</span></p>
                            <div class="details">
                                <p class="info date">
                                    <i class="far fa-calendar"></i>
                                    تاريخ الانضمام :
                                    {{ \Carbon\Carbon::parse($student->created_at)->locale('ar')->translatedFormat('d F Y') }}
                                </p>
                                <p class="info">
                                    <i class="far fa-calendar"></i>
                                    تاريخ اخر ظهور علي التطبيق :
                                    {{ $student->is_online == 1? \Carbon\Carbon::parse($student->online_date)->locale('ar')->translatedFormat('d F Y'): \Carbon\Carbon::parse($student->offline_date)->locale('ar')->translatedFormat('d F Y') }}
                                </p>
                                <p class="info">
                                    <i class="fas fa-star"></i>
                                    التقيم العام
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="name-cor">
                                <div class="form-group names">
                                    <label for="exampleFormControlSelect1">اسم الكورس</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-success names">اضافه</button>
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
                    <div class="col-lg-8 col-md-12 col-12">

                        <div class="basc">
                            <div class="basic_information">
                                <h3 class="title">البيانات الاساسية</h3>
                                <div class="info">
                                    <p class="title">رقم الهاتف</p>
                                    <p class="text">{{ $student->phone }}</p>
                                </div>
                                <div class="info">
                                    <p class="title">المرحله</p>
                                    <p class="text">
                                        @if ($student->stage)
                                            {{ $student->stage['stage_ar'] }}
                                        @else
                                            --
                                        @endif
                                    </p>
                                </div>
                                <div class="info">
                                    <p class="title">السنه</p>
                                    <p class="text">
                                        @if ($student->year)
                                            {{ $student->year->year_ar }}
                                        @else
                                            --
                                        @endif

                                    </p>
                                </div>
                                <div class="info">
                                    <p class="title">نوع الهاتف</p>
                                    <p class="text"> {{ $student->device_id }}</p>
                                </div>

                            </div>
                            <div class="basic_information">
                                <h3 class="title">المنصات</h3>
                                @forelse ($student->stdcenters as $center)
                                    <div class="info">
                                        <p class="title">{{ $center->name ?? '-' }} </p>
                                        {{-- <p class="text">العامه</p> --}}
                                    </div>
                                @empty
                                    <div class="info">
                                        <p class="title">المنصه </p>
                                        <p class="text">العامه</p>
                                    </div>
                                @endforelse
                                {{-- <div class="info">
                                    <p class="title">منصة مستر </p>
                                    <p class="text">محمد حسين</p>

                                </div>
                                <div class="info">
                                    <p class="title">منصة </p>
                                    <p class="text">د/ محمود العفيفي</p>
                                </div> --}}

                            </div>
                            <div class="table_details">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-coruses-tab" data-toggle="pill"
                                            href="#pills-coruses" role="tab" aria-controls="pills-coruses"
                                            aria-selected="true">الكورسات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-exams-tab" data-toggle="pill" href="#pills-exams"
                                            role="tab" aria-controls="pills-exams" aria-selected="false">الامتحانات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-History-tab" data-toggle="pill"
                                            href="#pills-History" role="tab" aria-controls="pills-History"
                                            aria-selected="false">History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-viwe-tab" data-toggle="pill" href="#pills-viwe"
                                            role="tab" aria-controls="pills-viwe" aria-selected="false">مشاهدات</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-coruses" role="tabpanel"
                                        aria-labelledby="pills-coruses-tab">

                                        @include('dashboard.students.profile-student-includes.__courses', [
                                            'courses' => $courses,
                                            'student' => $student,
                                        ])

                                    </div>
                                    <div class="tab-pane fade" id="pills-exams" role="tabpanel"
                                        aria-labelledby="pills-exams-tab">

                                        @include('dashboard.students.profile-student-includes.__exam')

                                    </div>
                                    <div class="tab-pane fade" id="pills-History" role="tabpanel"
                                        aria-labelledby="pills-History-tab">

                                        @include('dashboard.students.profile-student-includes.__history')

                                    </div>
                                    <div class="tab-pane fade" id="pills-viwe" role="tabpanel"
                                        aria-labelledby="pills-viwe-tab">

                                        @include('dashboard.students.profile-student-includes.__viwe')

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
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
                        </div> --}}
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


@section('scripts')
    <script>
        function deleteuser_from_stutypes(student_id, type_id) {

            console.log("type student ", student_id);
            console.log("type id", type_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: ' هل انت متاكد من حذف الطالب من هذا المحتوي ؟',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    var url = "{{ route('stutypes.deleteuser_from_stutypes') }}";

                    var table = $('.table').DataTable();

                    $.ajax({
                        type: "post",
                        url: url,

                        //  contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        data: {
                            'student_id': student_id,
                            'type_id': type_id,
                        },
                        //    contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        success: function(result) {
                            if (result.status == true) {
                                Swal.fire(
                                    'Deleted!',
                                    'تم مسح المستخدم بنجاح',
                                    'success'
                                )
                            }
                        }

                    });
                }
            })
        }
    </script>


    <script>
        function deleteuser_from_stutypescollege(student_id, typecollege_id) {
            console.log("typecolege student ", student_id);
            console.log("typecolege id", typecollege_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: ' هل انت متاكد من حذف الطالب من هذا المحتوي ؟',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    var url = "{{ route('stutypescollege.deleteuser_from_stutypescollege') }}";

                    var table = $('.table').DataTable();

                    $.ajax({
                        type: "post",
                        url: url,

                        //  contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        data: {
                            'student_id': student_id,
                            'typecollege_id': typecollege_id,
                        },
                        //    contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        success: function(result) {
                            if (result.status == true) {
                                Swal.fire(
                                    'Deleted!',
                                    result.message,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Error!',
                                    result.message,
                                    'error'
                                )
                            }
                        }

                    });
                }
            })
        }
    </script>
@endsection
