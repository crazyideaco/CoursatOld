<div class="form-group col-6">
    <label>المرحله</label>
    <select class="form-control selectpicker" name="stage_id" onchange="getstage_years(this)">
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
<div class="form-group col-6">
    <label>سنه الماده</label>
    <select class="form-control selectpicker" name="years_id" required id="year" onchange="getyear_subjects(this)">
        <option value="0" selected="selected" disabled="disabled">اختر السنه</option>

    </select>
    @error('years_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-4">
    <label>الماده </label>
    <select class="form-control selectpicker" name="subjects_id" required id="subject" onchange="getteacher(this)">
        <option value="0" selected="selected" disabled="disabled">اختر الماده</option>

    </select>
    @error('subjects_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
