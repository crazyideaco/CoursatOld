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

    div#general_settings {
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
    <label>تاريخ التسجيل من :</label>
    <input type="date" name="from_date" id="from_date" class="form-control" onchange="filter_students();">
</div>
<div class="form-group col-lg-3 col-md-6 col-12">
    <label>تاريخ التسجيل الي :</label>
    <input type="date" name="to_date" id="to_date" class="form-control" onchange="filter_students();">
</div>


<div class="form-group col-lg-3 col-md-6 col-12">
    {{-- <label>تاريخ التسجيل الي :</label> --}}
    <button onclick ="export_students()" class="btn btn-primary" style="width: 100%;">تصدير ملف excel</button>
</div>


