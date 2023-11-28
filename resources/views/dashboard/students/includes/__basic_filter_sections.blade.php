<style>
    .filter-option-inner-inner {
    color: black !important;
}
.all-products button {
    width: 100% !important;
}
:not(.input-group)>.bootstrap-select.form-control:not([class*=col-]) {
    width: 95% !important;
}
div#category_id_basic {
    background-color: #eaeaea87;
    border-radius: 10px
    padding: 0.5rem;
}
h4.hederre {
    font-family: "reg";
    font-size: 1.2rem;
}
</style>



<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>المرحله</label> --}}
    <select class="form-control selectpicker" name="stage_id" onchange="getstage_years(this);filter_students();" id="stage_id" title="ادخل المرحله ">
        {{-- <option value="0" selected="selected"  disabled="disabled">ادخل المرحله </option> --}}
        @foreach ($stages as $stage)
            <option value='{{ $stage->id }}'>{{ $stage->name_ar }}</option>
        @endforeach
    </select>
    @error('stage_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>سنه الماده</label> --}}
    <select class="form-control selectpicker" name="years_id"  id="years_id" onchange="getyear_subjects(this);filter_students();" title="اختر السنه">
        {{-- <option value="0" selected="selected" disabled="disabled">اختر السنه</option> --}}

    </select>
    @error('years_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>الماده </label> --}}
    <select class="form-control selectpicker" name="subjects_id"  id="subjects_id" onchange="getSubject_teacher(this)" title="اختر الماده">
        {{-- <option value="0" selected="selected" disabled="disabled">اختر الماده</option> --}}

    </select>
    @error('subjects_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>المدرسين </label> --}}
    <select class="form-control selectpicker" name="teachers"  id="teachers"  onchange="getTeacher_types(this)" title="اختر المدرس">
        {{-- <option value="0" selected="selected" disabled="disabled">اختر المدرس</option> --}}

    </select>
    @error('teacher_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>الكورسات </label> --}}
    <select class="form-control selectpicker" name="type_id"  id="type_id" onchange="filter_students();" title="اختر الكورسات">
        {{-- <option value="0" selected="selected" disabled="disabled">اختر الكورسات</option> --}}

    </select>
    @error('type_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>


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
                $('#years_id').empty();
                $('#years_id').html(result);
                $('#years_id').selectpicker('refresh');
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
                $('#subjects_id').empty();
                $('#subjects_id').html(result);
                $('#subjects_id').selectpicker('refresh');
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
        let subjectId = $('#subjects_id').val();
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
                $('#type_id').empty();
                $('#type_id').html(result);
                $('#type_id').selectpicker('refresh');
            }

        });
    }
</script>

{{-- function getsubjects_types(selected) {
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
                $('#type_id').empty();
                $('#type_id').html(result);
                $('#type_id').selectpicker('refresh');
            }

        });
    } --}}
