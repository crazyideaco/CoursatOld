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

    div#online_status {
        background-color: #f4f4f4;
        margin-top: 13px;
        border-radius: 10px;
        margin-top: 10px;
        padding: 0.5rem;
    }

    h4.hederre {
        font-family: "reg";
        font-size: 1.2rem;
    }
</style>

<div class="form-group col-lg-3 col-md-6 col-12">
    {{-- <label>الكورسات </label> --}}
    <select class="form-control selectpicker" name="is_online" id="is_online" onchange="filter_students();"
        title="اختر حالة الاونلاين او الاوفلاين">
        <option value="1">Online</option>
        <option value="0">Offline</option>

    </select>
    @error('is_online')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>


<div class="form-group col-lg-3 col-md-6 col-12">
    <label>من</label>
    <input type="date" name="from_date" id="from_date" class="form-control" onkeyup="filter_students();">
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>الي</label>
    <input type="date" name="to_date" id="to_date" class="form-control" onkeyup="filter_students();">
</div>
