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

    div#subscription_type {
        background-color: #eaeaea87;
        border-radius: 10px padding: 0.5rem;
    }

    h4.hederre {
        font-family: "reg";
        font-size: 1.2rem;
    }
</style>


<div class="form-group col-lg-2 col-md-6 col-12">
    {{-- <label>الكورسات </label> --}}
    <select class="form-control selectpicker" name="subscription_type" id="subscription_type" onchange="filter_students();"
        title="اختر نوع الاشتراك">
        <option value="0">اشتراك</option>
        <option value="1">شراء</option>
        <option value="2">طلب انضمام</option>
        <option value="3">scan Qrcode</option>
        <option value="4">Dashboard</option>

    </select>
    @error('subscription_type')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>
