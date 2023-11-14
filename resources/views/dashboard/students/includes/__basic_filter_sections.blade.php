<div class="form-group col-lg-3 col-md-6 col-12">
    <label>المرحله</label>
    <select class="form-control selectpicker" name="stage_id" onchange="getstage_years(this);filter_students()" id="stage">
        <option value="0" selected="selected" required disabled="disabled">ادخل المرحله
        </option>
        @foreach ($stages as $stage)
            <option value='{{ $stage->id }}'>{{ $stage->name_ar }}</option>
        @endforeach
    </select>
    @error('stage_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>سنه الماده</label>
    <select class="form-control selectpicker" name="years_id" required id="year" onchange="getyear_subjects(this);filter_students()">
        <option value="0" selected="selected" disabled="disabled">اختر السنه</option>

    </select>
    @error('years_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>الماده </label>
    <select class="form-control selectpicker" name="subjects_id" required id="subject" onchange="getTeachers(this)">
        <option value="0" selected="selected" disabled="disabled">اختر الماده</option>

    </select>
    @error('subjects_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
    <label>المدرسين </label>
    <select class="form-control selectpicker" name="teacher_id" required id="teachers"  onchange="getTeacher_types(this)">
        <option value="0" selected="selected" disabled="disabled">اختر المدرس</option>

    </select>
    @error('teacher_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
    <label>الكورسات </label>
    <select class="form-control selectpicker" name="type_id" required id="types">
        <option value="0" selected="selected" disabled="disabled">اختر الكورسات</option>

    </select>
    @error('type_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
