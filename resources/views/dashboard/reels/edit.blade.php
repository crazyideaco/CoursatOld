@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
    <div class="content_page">
        <div class="container">
            <!-- header section -->
            <div class="main_topic">
                <h4>{{__('messages.edit reel')}}</h4>
            </div>

            <form class="form_topic" action="{{route('reels.update',$reel->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- start input -->
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label"> {{ __('messages.name') }}</label>
                            <input required type="text" name="name" value="{{$reel->name}}" placeholder="{{ __('messages.name') }}" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- finish input -->

                <!-- start input -->
                <div class="row">
                    <div class="input-group pt-4">
                        <div class="file-upload-wrapper"
                             data-text="{{ __('messages.Drag the video you want to add or open it from here') }}">
                            <input name="video" type="file"
                                   class="file-upload-field"  value="{{$reel->video}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 mx-auto text-center mb-5 set-img">
                    <video width="200" height="200" controls>
                        <source src="{{ $reel->video_link ?? '' }}" id="video_here">
                        Your browser does not support HTML5 video.
                    </video>

                    @error('video')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label">{{__('messages.educational stages')}}</label>


                            <div class="form-check form-check-inline">
                                <input
                                @if($reel->category_id == 1)
                                checked
                                @endif
                                 class="form-check-input" type="radio" name="category_id" id="radio1"
                                    onchange="toggleRow()" value="1">
                                <label class="form-check-label" for="radio1">{{__('messages.basic')}}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                @if($reel->category_id == 2)
                                checked
                                @endif
                                 class="form-check-input" type="radio" name="category_id" id="radio2"
                                    onchange="toggleRow()" value="2">
                                <label class="form-check-label" for="radio2">{{__('messages.university education')}}</label>
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
                <div  id="mainEducation" @if($reel->category_id == 2) class="main_education" @endif >
                    <h4>{{__('messages.basic')}}</h4>
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
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.basic_education_type')}}</label>
                                <select class="selectpicker"  name="basic_education_type_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" id="basic_education_type_id"
                                    onchange="filter_teacher_stages()">
                                    @foreach($basic_education_types as $basic_education_type)
                                <option value="{{$basic_education_type->id}}"
                                    @if($basic_education_type->id == $reel->information?->basic_education_type_id)
                                    selected
                                    @endif
                                    >{{$basic_education_type->title}}</option>
                             @endforeach
                                </select>

                            </div>



                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.stage')}}</label>
                                <select class="selectpicker"  name="stage_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" id="stage_id"
                                    onchange="filter_teacher_years_by_stage_ids()">
                                    @foreach ($stages as $stage)
                                    <option value="{{$stage->id}}"
                                        @if($stage->id == $reel->information?->stage_id)
                                    selected
                                    @endif
                                        >{{$stage->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.year')}}</label>
                                <select class="selectpicker"  name="year_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" id="year_id" title="&nbsp;">
                                    @foreach ($years as $year)
                                    <option value="{{$year->id}}"
                                        @if($year->id == $reel->information?->year_id)
                                        selected
                                        @endif
                                        >{{$year->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main education -->

                <!-- university education -->
                <div  @if($reel->category_id == 1) class="university_education" @endif id="universityEducation">
                    <h4>{{__('messages.university education')}}</h4>
                    <div  class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.university_education_type')}}</label>
                                <select class="selectpicker"  name="university_education_type_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" id="university_education_type_id"
                                    onchange="filter_teacher_universities()">
                                    @foreach ($university_education_types as $university_education_type)
                                    <option value="{{$university_education_type->id}}"
                                        @if($university_education_type->id == $reel->information?->university_education_type_id)
                                        selected
                                        @endif
                                        >{{$university_education_type->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.university')}}</label>
                                <select class="selectpicker"  name="university_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" onchange="filter_teacher_colleges_by_university_ids()"
                                    id="university_id">
                                    @foreach ($universities as $university)
                                    <option value="{{$university->id}}"
                                        @if($university->id == $reel->information?->university_id)
                                        selected
                                        @endif
                                        >{{$university->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.college')}}</label>
                                <select class="selectpicker"  name="college_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" id="college_id" onchange="filter_teacher_departments_by_college_ids()">
                                    @foreach ($colleges as $college)
                                    <option value="{{$college->id}}"
                                        @if($college->id == $reel->information?->college_id)
                                        selected
                                        @endif
                                        >{{$college->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.department')}}</label>
                                <select class="selectpicker"  name="department_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" title="&nbsp;" id="department_id"
                                   onchange="filter_teacher_divisions_by_department_ids()">
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}"
                                        @if($department->id == $reel->information?->department_id)
                                        selected
                                        @endif
                                        >{{$department->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <label class="form-label">{{__('messages.division')}}</label>
                                <select class="selectpicker"  name="division_id"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true" id="division_id" title="&nbsp;">
                                    @foreach ($divisions as $division)
                                    <option value="{{$division->id}}"
                                        @if($division->id == $reel->information?->division_id)
                                        selected
                                        @endif
                                        >{{$division->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="input-group">
                                <label class="form-label"> المواد</label>
                                <select required class="selectpicker"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="form-label"> الترم</label>
                                <select required class="selectpicker"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- finish input -->
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn first">{{ __('messages.update') }}</button>
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
