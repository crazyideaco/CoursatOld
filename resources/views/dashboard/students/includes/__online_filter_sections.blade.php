
<div class="form-group col-lg-3 col-md-6 col-12">
    {{-- <label>الكورسات </label> --}}
    <select class="form-control selectpicker" name="is_online"  id="is_online"
        onchange="filter_students();" title="اختر حالة الاونلاين او الاوفلاين">
        {{-- <option value="0" selected="selected" disabled="disabled">اختر الكورسات</option> --}}

    </select>
    @error('is_online')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
