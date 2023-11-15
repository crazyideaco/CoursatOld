@extends('App.dash')
@section('style')
    <style>
        #example_wrapper {
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
                        <h5>الطلاب</h5>



                    </div>

                    <div class="products-search typs1">


                    </div>



                    <div class="pt-5">
                        <div class="row" id="category_id_basic">
                            @include('dashboard.students.includes.__basic_filter_sections')
                        </div>


                        <div class="row" id="category_id_college">
                            @include('dashboard.students.includes.__college_filter_sections')
                        </div>
                        {{-- <div class="row">
                            <div class="col-3 mx-auto">


                                <span class="btn btn-primary" onclick="filterbasicstudents()">بحث</span>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="table-responsive">

                                {!! $dataTable->table(
                                    [
                                        'class' => 'table_expenses table_topic table table-striped table-bordered',
                                    ],
                                    true,
                                ) !!}

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
    </div>
    <!--end page-body-->
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    {{ $dataTable->scripts() }}


    <script>
        function activeuser(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `activeuser/${id}`,
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
                        $(`#btn${id}`).html('تفعيل');

                    } else if (result.status == 'active') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم التفعيل  ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#btn${id}`).html('الغاء التفعيل');

                    }

                }

            });
        }

        function deleteuser(sel) {
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

                        url: `deleteuser/${id}`,
                        //    contentType: "application/json; charset=utf-8",
                        dataType: "Json",
                        success: function(result) {
                            if (result.status == true) {
                                $(`#s${id}`).remove();
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

        function student_logout(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `student_logout/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم  تسجيل الخروج ',
                            showConfirmButton: false,
                            timer: 1500
                        });


                    }

                }

            });
        }
    </script>


{{-- basic filters --}}
<script>
    function getstage_years(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getstage/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#year').empty();
                $('#year').html(result);
                $('#year').selectpicker('refresh');
            }

        });
    }

    function getyear_subjects(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getyear/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#subject').empty();
                $('#subject').html(result);
                $('#subject').selectpicker('refresh');
            }

        });
    }

    function getsubjects_types(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getsubject_types/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#types').empty();
                $('#types').html(result);
                $('#types').selectpicker('refresh');
            }

        });
    }

    function getSubject_teacher(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getSubject_teacher/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#teachers').empty();
                $('#teachers').html(result);
                $('#teachers').selectpicker('refresh');
            }
        });
    }

    function getTeacher_types(teacherId) {
        let subjectId =  $('#subject').val();
        let teacherId = teacherId.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `gettype/${subjectId}/${teacherId}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#types').empty();
                $('#types').html(result);
                $('#types').selectpicker('refresh');
            }

        });
    }
</script>


 {{-- college filters --}}
 <script>
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
                $('.selectpicker').selectpicker('refresh');
                console.log(result);
            }

        });
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
                $('.selectpicker').selectpicker('refresh');
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
                $('.selectpicker').selectpicker('refresh');
            }

        });
    }

    function getsection_subjectsCollege(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getsection_subjectsCollege/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#subject_college').empty();
                $('#subject_college').html(result);
                $('#subject_college').selectpicker('refresh');
            }

        });
    }



    function getSubject_teacherCollege(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getSubject_teacherCollege/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#teachers_college').empty();
                $('#teachers_college').html(result);
                $('#teachers_college').selectpicker('refresh');
            }
        });
    }


    function getTeacher_typescollege(subjectId,teacherId) {
        let subjectId = subjectId.value;
        let teacherId = teacherId.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getTeacher_typescollege/${subjectId}/${teacherId}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#typescollege').empty();
                $('#typescollege').html(result);
                $('#typescollege').selectpicker('refresh');
            }

        });
    }
</script>

{{-- <script>
    function filter_based_on_category_id_education() {

        // // Get selected options
        // var selected = $("#issue_type_id option:selected");

        // var issue_types = selected.map(function() {
        //     return $(this).val();
        // }).get(); // Convert to an array


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: `{{ route('client.issues.index') }}`,
            type: 'POST',
            data: {
                "word": $(".word").val(),
                "session_date": session_date,
                "issue_types": issue_types,
                "issue_status": issue_status,
            },


        }).done(function(result) {
            // $('.selectpicker').selectpicker('refresh');
            $('.category_id_basic').html(result);
        }).fail(function(result) {
            $('.case_container').html(result);
        });

    }
</script> --}}

<script>
    function filter_students() {
        $('#dataTableBuilder').on('preXhr.dt', function(e, settings, data) {
            //basic filters
            data.stage_id = $("#stage").val();
            data.years_id = $("#year").val();
            data.type_id = $("#types").val();
            // //college filters
            data.university_id = $("#university").val();
            data.college_id = $("#college").val();
            data.division_id = $("#division").val();
            data.section_id = $("#section").val();
            data.types_college_id = $("#typescollege").val();
        });
        $('#dataTableBuilder').DataTable().ajax.reload();
    }
</script>




@endsection
