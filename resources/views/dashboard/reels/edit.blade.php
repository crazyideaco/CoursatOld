@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
    <div class="page-body">
        <div class="container">
            <!-- header section -->
            <div class="main_topic">
                <h4>تعديل فيديو قصير</h4>
            </div>

            <form class="form_topic" action="{{route('reels.update',$reel->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- start input -->
                <div class="row">
                    <div class="col-8 mx-auto">
                        <div class="uploadOuter">
                            <span class="dragBox">

                                Darg and Drop image here
                                <input type="file" name="image" onChange="dragNdrop(event)" ondragover="drag()"
                                    ondrop="drop()" id="uploadFile" />
                            </span>
                        </div>

                        <div id="preview">
                            @error('image')
                                <span class="invalid-feedback">
                                    {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label"> الاسم</label>
                            <input required type="text" name="name" placeholder="الاسم" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label"> لينك الفيديو</label>
                            <input required type="text" name="video" placeholder="لينك الفيديو" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- finish input -->

                <!-- start input -->


                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label">نوع التعليم</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category_id" id="radio1"
                                    onchange="toggleRow()" value="1">
                                <label class="form-check-label" for="radio1">اساسي</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category_id" id="radio2"
                                    onchange="toggleRow()" value="2">
                                <label class="form-check-label" for="radio2">جامعي</label>
                            </div>

                            {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="educationType" id="radio3"
                                onchange="toggleRow()" value="option3">
                            <label class="form-check-label" for="radio3">تعليم حر</label>
                        </div> --}}
                        </div>
                    </div>
                </div>
                <!-- finish input -->

                <!-- main education -->
                <div class="main_education" id="mainEducation">
                    <h4>اساسي</h4>
                    <div class="row">
                        {{-- <div class="col-12">
                        <div class="input-group">
                            <label class="form-label"> الصلاحيات</label>
                            <select required class="selectpicker"
                                data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                data-live-search="true">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div> --}}
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>المرحله</label>
                            <select class="form-control selectpicker" name="stage_id" onchange="getstage_years(this)"
                                id="stage" title="ادخل المرحله ">
                                {{-- <option value="0" selected="selected" required disabled="disabled">ادخل المرحله </option> --}}
                                @foreach ($stages as $stage)
                                    <option value='{{ $stage->id }}'
                                        {{-- @if($stage->id == $reel->information?->stage_id)
                                        selected
                                        @endif --}}
                                        >{{ $stage->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('stage_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>سنه الماده</label>
                            <select class="form-control selectpicker" name="year_id"  id="year"
                                onchange="getyear_subjects(this)" title="اختر السنه">

                                {{-- <option value="0" selected="selected" disabled="disabled">اختر السنه</option> --}}

                            </select>
                            @error('years_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>الماده </label>
                            <select class="form-control selectpicker" name="subject_id"  id="subject"
                                onchange="getSubject_teacher(this)" title="اختر الماده">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر الماده</option> --}}

                            </select>
                            @error('subjects_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>المدرسين </label>
                            <select class="form-control selectpicker" name="teacher_id"  id="teachers"
                                onchange="getTeacher_types(this)" title="اختر المدرس">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر المدرس</option> --}}

                            </select>
                            @error('teacher_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- main education -->



                <!-- university education -->
                <div class="university_education" id="universityEducation">
                    <h4>جامعي</h4>
                    <div class="row">

                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الجامعه </label>
                            <select name="university_id"  class="form-control selectpicker" id="university"
                                onchange="getcolleges(this)" title="اختر جامعه">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر جامعه</option> --}}
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
                            <select name="college_id"  class="form-control selectpicker" id="college"
                                onchange="getdivision(this)" title="اختر كليه">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر كليه</option> --}}

                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم القسم </label>
                            <select name="division_id"  class="form-control selectpicker" id="division"
                                onchange="getsection(this)" title="اختر قسم">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر قسم</option> --}}

                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>اسم الفرقه </label>
                            <select name="section_id"  class="form-control selectpicker" id="section"
                                onchange="getsection_subjectsCollege(this)" title="اختر فرقه">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر فرقه</option> --}}

                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>الماده </label>
                            <select class="form-control selectpicker" name="subjectscollege_id" title="اختر الماده "
                                 id="subject_college" onchange="getSubject_teacherCollege(this)">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر الماده</option> --}}

                            </select>
                            @error('subjects_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-12">
                            <label>المدرسين </label>
                            <select class="form-control selectpicker" name="doctor_id"  title="اختر المدرس"ed
                                id="teachers_college" onchange="getTeacher_typescollege(this)">
                                {{-- <option value="0" selected="selected" disabled="disabled">اختر المدرس</option> --}}

                            </select>
                            @error('teacher_id')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- finish input -->
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn first">حفظ</button>
                    </div>
                </div>


            </form>
        </div>
    </div>


    <script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-select.min.js"></script>
<script src="../js/main.js"></script>
    <script>
        // This function for main education
        function toggleRow() {
            var checkbox = document.getElementById('radio1');
            var hiddenRow = document.getElementById('mainEducation');
            var checkbox2 = document.getElementById('radio2');
            var hiddenRow2 = document.getElementById('universityEducation');
            // var checkbox3 = document.getElementById('radio3');
            // var hiddenRow3 = document.getElementById('freeEducation');

            if (checkbox.checked) {
                // Show the hidden row
                hiddenRow.classList.remove('main_education');
                hiddenRow2.classList.add('university_education');
                hiddenRow3.classList.add('free_education');
            }
            else if(checkbox2.checked) {
                // Show the hidden row
                hiddenRow.classList.add('main_education');
                hiddenRow2.classList.remove('university_education');
                hiddenRow3.classList.add('free_education');

            }
            else  if(checkbox3.checked) {
                // Show the hidden row
                hiddenRow.classList.add('main_education');
                hiddenRow2.classList.add('university_education');
                hiddenRow3.classList.remove('free_education');
            }



        }


        </script>
        <!-- show main education -->

@endsection
@section('scripts')
    <script>
        function getstage_years(selected) {
            let id = selected.value;
            var url = `{{ route('getstage',':id') }}`;
            url = url.replace(':id',id);
            console.log('getstage_years');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
                data: {
                    "id": id
                },
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
            var url = `{{ route('getyear',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#subject').empty();
                    $('#subject').html(result);
                    $('#subject').selectpicker('refresh');
                }

            });
        }



        function getSubject_teacher(selected) {
            let id = selected.value;
            var url = `{{ route('getSubject_teacher',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
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
            let subjectId = $('#subject').val();
            let teacher_id = $('#teachers').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getteacher_type/${subjectId}/${teacher_id}`,
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
    <script>
        function getcolleges(selected) {
            let id = selected.value;
            var url = `{{ route('getcolleges',':id') }}`;
            url = url.replace(':id',id);
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
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
            var url = `{{ route('getdivision',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url ,
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
            var url = `{{ route('getsection',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
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
            var url = `{{ route('getsection_subjectsCollege',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url,
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
            var url = `{{ route('getSubject_teachercollege',':id') }}`;
            url = url.replace(':id',id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: url ,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    $('#teachers_college').empty();
                    $('#teachers_college').html(result);
                    $('#teachers_college').selectpicker('refresh');
                }
            });
        }


        function getTeacher_typescollege(teacherId) {
            let subjectId = $('#subject_college').val();
            let teacher_id = $('#teachers_college').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `getTeacher_typescollege/${subjectId}/${teacher_id}`,
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
@endsection