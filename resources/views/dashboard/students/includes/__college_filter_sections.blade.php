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

    </select>
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>اسم القسم </label>
    <select name="division_id" required class="form-control" id="division"
        onchange="getsection(this)">
        <option value="0">اختر قسم</option>

    </select>
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>اسم الفرقه </label>
    <select name="section_id" required class="form-control" id="section">
        <option value="0">اختر فرقه</option>

    </select>
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>الماده </label>
    <select class="form-control selectpicker" name="subjects_id" required id="subject">
        <option value="0" selected="selected" disabled="disabled">اختر الماده</option>

    </select>
    @error('subjects_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
