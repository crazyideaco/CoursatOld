<style>
    h3.card-label {
    font-family: 'med';
}
.card-toolbar a.btn.first {
    background-color: #243e56;
    color: white;
    font-family: 'reg';

}
.table tbody tr td {
    background: unset !important;
}
.table thead tr th {
    background: unset !important;
}
div#dataTableBuilder_wrapper {
    font-family: 'med';
}
button {
    background-color: #243e56 !important;
    color: white !important;
    border: unset !important;
    font-family: 'reg';
    border-radius: 10px !important;
    padding: 0.5rem 1rem !important;
    margin-right: 27px !important;
    cursor: pointer !important;
    transition: 0.7s
}
button:hover {
    background-color: white;
    color: #243e56;
}
div#dataTableBuilder_length {
    margin-top: 19px;
}
</style>



@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
    <!---------------------- start content -------------------------------------------->
    <div class="content_page">
        <div class="container">
            <!-- header section -->
            <div class="main_topic">
                <h4> اعدادات الامان</h4>
            </div>
            <form method="post" class="form_topic" action="{{ route('security.update', $id) }}" enctype="multipart/form-data">
                @csrf

                <!-- start input -->

                <!-- start input -->
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label"> كود الفيديوهات</label>
                            <div class="form-check form-check-inline">
                                <input @if ($security_setting && $security_setting->show_video_code == 1) checked @endif onchange="toggleCode()"
                                    class="form-check-input" type="radio" id="inlineCheckbox6" value="1"
                                    name="show_video_code">
                                <label class="form-check-label" for="inlineCheckbox6">عرض</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @if ($security_setting && $security_setting->show_video_code == 0) checked @endif onchange="toggleCode()"
                                    name="show_video_code" class="form-check-input" type="radio" id="inlineCheckbox7"
                                    value="0">
                                <label class="form-check-label" for="inlineCheckbox7"> اخفاء</label>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- finish input -->
                {{-- <div class="course_price" id="ShowCode">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <label class="form-label">{{ __('messages.code_type') }}</label>
                                <select required class="selectpicker" name="video_code_type"
                                    data-selected-text-format="count > 1" data-icon="bi bi-trash"
                                    data-live-search="true">
                                    <option value="1" @if ($security_setting->video_code_type == 1) selected @endif>{{__('messages.fixed')}}</option>
                                    <option value="0" @if ($security_setting->video_code_type == 0) selected @endif>{{__('messages.dynamic')}}</option>
                                    <option value="2" @if ($security_setting->video_code_type == 2) selected @endif>{{__('messages.hide_and_apear')}}</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="course_price" id="ShowCode">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-label">حاله الفيديو</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="video_code_type" type="radio" id="radio4"
                                    value="1" onchange="togglePrice()"
                                    {{ $security_setting->video_code_type == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox1">متحرك</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="video_code_type" type="radio" id="radio5"
                                    value="0" onchange="togglePrice()"
                                    {{ $security_setting->video_code_type == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox2">ثابت</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="video_code_type" type="radio" id="radio6"
                                    value="2" onchange="togglePrice()"
                                    {{ $security_setting->video_code_type == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox2">
                                    يختفي ويظهر</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course_price" id="static">
                    <div class="row">
                        <label class="form-label">Code Duration</label>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <input type="number" name="code_duration"
                                    value="{{ $security_setting ? $security_setting->code_duration : '' }}"
                                    class="form-control @error('code_duration') is-invalid @enderror">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn first">حفظ</button>
                    </div>
                </div>
            </form>

        </div>


    </div>
    <!---------------------- finish  content -------------------------------------------->

    </section>
    <!---------------------- finish main content -------------------------------------------->

    </main>



    <!-- main js -->
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- main js -->

    <!-- show / hide  vedio limit -->
    <script>
        function toggleVedio() {
            var checkbox = document.getElementById('inlineRadio1');
            var checkboxSec = document.getElementById('inlineRadio2');
            var hiddenRow = document.getElementById('vedioLimit');

            if (checkbox.checked) {
                // Show the hidden row
                hiddenRow.classList.remove('course_price');
            } else if (checkboxSec.checked) {
                // Hide and remove the row
                hiddenRow.classList.add('course_price');
            }
            // else{
            //     hiddenRow.classList.remove('course_price');
            // }
        }
    </script>
    <!-- show / hide  vedio limit -->

    <!-- show / hide  vedio limit -->
    <script>
        toggleCode();
        toggleVedio();
        setTimeout(() => {
            togglePrice();

        }, 2000);
        function toggleCode() {
            var checkbox = document.getElementById('inlineCheckbox6');
            var checkboxSec = document.getElementById('inlineCheckbox7');
            var hiddenRow = document.getElementById('ShowCode');

            if (checkbox.checked) {
                // Show the hidden row
                hiddenRow.classList.remove('course_price');
            } else if (checkboxSec.checked) {
                // Hide and remove the row
                hiddenRow.classList.add('course_price');
            }
        }
    </script>
    <script>

        function togglePrice() {
            var fixedbox = document.getElementById('radio4');
            var dynamicbox = document.getElementById('radio5');
            var fixedynamicbox = document.getElementById('radio6');
            var hiddenRow = document.getElementById('static');

            if (fixedynamicbox.checked) {
                hiddenRow.classList.remove('course_price');
            } else if (fixedbox.checked || dynamicbox.checked) {
                // Show the hidden row
                hiddenRow.classList.add('course_price');
                console.log('sassa');
            }

        }
    </script>
    <!-- show / hide  vedio limit -->
@endsection
