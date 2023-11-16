@extends('App.dash')
@section('style')
    <style>
        #example_wrapper {
            width: 100% !important;
        }

        .all-products #btn1 {
            margin-right: 0 !important;
        }

        .all-products #btn2 {
            margin-right: 0 !important;
        }

        .btning {
            background-color: green !important;
            width: fit-content !important;
            font-size: 11px;
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


            <!--start setting-->
            <div class="setting all-products typs">
                <div class="container">
                    <div class="row def">

                        <img src="images/all-products.svg">
                        <h5>كورس
                        </h5>



                    </div>

                    <div class="products-search typs1">
                        <div class="row">
                            <button class="btn">
                                <a href="{{ route('addtypescollege') }}"> <span><i class="fas fa-plus-circle"></i></span>
                                    اضافه كورس
                                </a>
                            </button>

                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الجامعه </label>
                            <select name="university_id" required class="form-control" id="university"
                                onchange="getcolleges(this)">
                                <option value="0">اختر جامعه</option>
                                @foreach ($universities as $university)
                                    <option value="{{ $university->id }}">
                                        {{ $university->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('university_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الكليه </label>
                            <select name="college_id" required class="form-control" id="college"
                                onchange="getdivision(this)">
                                <option value="0">اختر كليه</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->id }}">{{ $college->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم القسم </label>
                            <select name="division_id" required class="form-control" id="division"
                                onchange="getsection(this)">
                                <option value="0">اختر قسم</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الفرقه </label>
                            <select name="section_id" required class="form-control" id="section"
                                onchange="getsubcollege(this)">
                                <option value="0">اختر فرقه</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الماده </label>
                            <select name="subjectscollege_id" required class="form-control" id="subcollege"
                                onchange="getdoctor(this)">
                                <option value="0">اختر ماده</option>
                                @foreach ($subcolleges as $subcollege)
                                    <option value="{{ $subcollege->id }}">{{ $subcollege->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>الشهر </label>
                            <input type="month" class="form-control" id="month" name="month"
                                value="{{ \Carbon\Carbon::now()->format('Y-m') }}" />
                            @error('month')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>



                    <div class="row">


                        <span class="btn btn-primary" onclick="filtertypescollege()"
                            style="width: 23%;
                                display: block;
                                margin: 0 auto;">
                            <i class="fas fa-search" style="margin-left: 10px;"> </i> بحث </span>
                    </div>
                </div>
                <div class="pt-5">
                    <div class="row">

                        <table id="example" class="table table-responsive col-12" style="width:100%">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td scope="col" class="text-center"> اسم الكورس</td>
                                    <td scope="col" class="text-center">اسم الماده</td>
                                    <td scope="col" class="text-center">نوع المنصة</td>
                                    <td scope="col" class="text-center">القسم</td>
                                    <th scope="col" class="text-center">الفرقه</th>
                                    <th scope="col" class="text-center">اسم الكليه</th>
                                    <th scope="col" class="text-center">اسم الجامعه </th>
                                    <th scope="col" class="text-center">تاريخ إنشاء الكورس </th>
                                    <th scope="col" class="text-center">الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody id="typescolleges">
                                @foreach ($typescolleges as $typescollege)
                                    <tr id="un{{ $typescollege->id }}">
                                        <td>{{ $typescollege->id }}</td>
                                        <td scope="row" class="text-center">
                                            <a href="{{ route('lessons', $typescollege) }}">
                                                {{ $typescollege->name_ar }}</a>
                                        </td>

                                        <td scope="row" class="text-center">
                                            {{ $typescollege->subjectscollege->name_ar }}
                                        </td>


                                        <td scope="row" class="text-center">
                                            {{ $typescollege->center ? $typescollege->center->name ?? 'المنصه العامه' :  "المنصه العامه" }}
                                        </td>

                                        <td scope="row" class="text-center">
                                            {{ $typescollege->section->name_ar }}</td>
                                        <td scope="row" class="text-center">
                                            {{ $typescollege->division->name_ar }}</td>
                                        <td class="text-center">{{ $typescollege->college->name_ar }}</td>
                                        <td class="text-center">{{ $typescollege->university->name_ar }}</td>
                                        <td class="text-center">{{ $typescollege->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edittypescollege', $typescollege->id) }}"> <img
                                                    src="{{ asset('images/pen.svg') }}" id="pen"
                                                    style="cursor: pointer"></a>
                                            <span class="btn bg-success text-white btn-sm btning"
                                                id="now{{ $typescollege->id }}"
                                                onclick="activetypecollege({{ $typescollege->id }})">

                                                @if ($typescollege->active == 1)
                                                    الغاء التفعيل
                                                @else
                                                    تفعيل
                                                @endif
                                            </span>
                                            <a href="{{ route('groupstypescollege', $typescollege->id) }}"
                                                class="btn bg-success text-white btn-sm btning">المجموعات</a>
                                            @if (auth()->user()->hasPermission('typescolleges-delete'))
                                                <img src="{{ asset('images/trash.svg') }}" id="trash"
                                                    onclick="deletetypescollege('{{ $typescollege->id }}')"
                                                    style="cursor:pointer;">
                                            @endif
                                            <a class="btn btn-primary btn-sm mt-2"
                                                href="{{ route('typescollegeexams', $typescollege->id) }}">
                                                الامتحانات
                                            </a>
                                            <a class="btn btn-primary btn-sm mt-2"
                                                href="{{ route('studentstypecollege', $typescollege->id) }}">
                                                الطلاب
                                            </a>
                                            <a class="btn btn-primary btn-sm mt-2"
                                                href="{{ route('bannedStudentstypecollege', $typescollege->id) }}">
                                                الطلاب المحذوفين
                                            </a>
                                            <span class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#myModal{{ $typescollege->id }}">create qrcode</span>
                                        </td>
                                    </tr>
                                    <div class="modal" id="myModal{{ $typescollege->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">create qrcode
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label>count </label>
                                                            <input class="form-control" value="1"
                                                                id="count{{ $typescollege->id }}">
                                                        </div>

                                                        <div class="col-12">
                                                            <label>expire date </label>
                                                            <input class="form-control" type="date"
                                                                id="expire_date{{ $typescollege->id }}">
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div id="qrcodes{{ $typescollege->id }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <button type="button" class="btn btn-success mx-auto"
                                                            onclick="store_qrcodes({{ $typescollege->id }})">save</button>

                                                        <button class="btn btn-primary waves-effect waves-light mr-12"
                                                            type="button" onclick=" printDiv('qrcodes{{ $typescollege->id }}');">
                                                            طباعة ال QR
                                                        </button>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

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
    </div>
    <!--end page-body-->
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        function store_qrcodes(typescollege_id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                data: {
                    'type_id': typescollege_id,
                    'count': $(`#count${typescollege_id}`).val(),
                    'expire_date': $(`#expire_date${typescollege_id}`).val(),
                },
                url: `{{ route('store_course_college_qrcode') }}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#qrcodes${typescollege_id}`).html(result.html);

                        // $(`#myModal${typescollege_id}`).modal('hide');
                        // table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message
                        })
                    }
                }
            });
        }
    </script>
    <script>
        function printDiv(divName) {
            var PrintContent = document.getElementById(divName).innerHTML;
            const y = window.top.outerHeight / 2 + window.top.screenY - (530 / 2);
            const x = window.top.outerWidth / 2 + window.top.screenX - (400 / 2);
            var PrintWindow = window.open('', '',
                `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=400, height=530, top=${y}, left=${x}`
            );
            PrintWindow.document.write('<html><head></head><body>');
            PrintWindow.document.write(PrintContent);
            PrintWindow.document.write('</body></html>');
            setTimeout(function() {
                PrintWindow.focus();
                PrintWindow.print();
                PrintWindow.close();
            }, 500);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "desc"]
                ], // Order on init. # is the column, starting at 0});
                columnDefs: [{
                    //   targets: 0,
                    //  visible : false,


                }, ]

            });
        });


        function activetypecollege(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `activetypecollege/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    if (result.status == 'deactive') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم الغاء التفعيل ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#now${id}`).html('تفعيل');

                    } else if (result.status == 'active') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم التفعيل  ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#now${id}`).html('الغاء التفعيل');

                    }

                }

            });
        }


        function deletetypescollege(sel) {
            let id = sel;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'هل انت متاكد',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `deletetypescollege/${id}`,
                        //    contentType: "application/json; charset=utf-8",
                        //       dataType: "Json",
                        success: function(result) {
                            if (result.status == true) {
                                $(`#un${id}`).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'تم مسح الكورس بنجاح',
                                    'success'
                                )
                            }
                        }

                    });
                }


            })
        }

        function getdivision(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getdivision/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#division').empty();
                    $('#division').html(result);
                }

            });
        }

        function getsection(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getsection/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#section').empty();
                    $('#section').html(result);
                }

            });
        }

        function getsubcollege(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getsubcollege/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#subcollege').empty();
                    $('#subcollege').html(result);
                }

            });
        }

        function getdocsection(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getdocsection/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#section').empty();
                    $('#section').html(result);
                }

            });
        }

        function getdocsubcollege(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getdocsubcollege/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#subcollege').empty();
                    $('#subcollege').html(result);
                }

            });
        }

        function getdoctor(selected) {
            let id = selected.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getdoctor/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#doctore').empty();
                    $('#doctor').html(result);
                }

            });
        }

        function getcolleges(selected) {
            let id = selected.value;
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getcolleges/${id}`,
                //    contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#college').empty();
                    $('#college').html(result.data);
                    console.log(result);
                }

            });
        }

        function filtertypescollege() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: `filtertypescollege`,
                //   contentType: "application/json; charset=utf-8",
                dataType: "Json",
                data: {
                    "university_id": $("#university").val(),
                    "college_id": $("#college").val(),
                    "division_id": $("#division").val(),
                    "section_id": $("#section").val(),
                    "subjectscollege_id": $("#subcollege").val(),

                },
                success: function(result) {
                    if (result.status == true) {
                        $('#example').DataTable().destroy();
                        $("#typescolleges").empty();
                        $("#typescolleges").append(result.data);
                        $('#example').DataTable().draw();
                    }

                }

            });
        }
    </script>
@endsection
