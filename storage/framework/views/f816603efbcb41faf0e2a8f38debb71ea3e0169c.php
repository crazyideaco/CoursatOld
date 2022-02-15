
<?php $__env->startSection('content'); ?>
<style>
    .setting .info button {
        width: 100% !important;
    }

    .bootstrap-select .dropdown-toggle .filter-option {
        text-align: start !important;
    }
</style>
<!--start page-body-->
<div class="page-body">
    <div class="container">

        <!--start heed-->
        <div class="heed">

            <div class="row">
                <div class="profile">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo e(asset('images/profile.svg')); ?>">
                        </div>
                        <div class="col-6">
                            <h5><?php echo e(auth()->user()->name); ?></h5>
                            <p>ادمن</p>

                        </div>


                    </div>
                </div>
                <div class="flag">

                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo e(asset('images/flag.svg')); ?>">
                        </div>
                        <div class="col-4">
                            <h5>العربية</h5>


                        </div>



                    </div>

                </div>


                <div class="noti text-center">
                    <span><i class="far fa-bell"></i></span>
                </div>



                <div class="search">

                    <input type="text" name="search">
                    <span class="srch"><i class="fas fa-search"></i></span>

                </div>

                <div class="datee">
                    <div class="row">
                        <span><i class="far fa-calendar-alt"></i></span>
                        <p><?php echo e(Carbon\Carbon::now()->format('d-m-Y')); ?></p>
                    </div>
                </div>


            </div>


        </div>
        <!--end heed-->


        <!--start setting-->
        <div class="setting">
            <div class="container">
                <div class="row def">
                    <img src="<?php echo e(asset('images/setting.svg')); ?>">
                    <h5>ارسال الاشعارات </h5>
                </div>



                <div class="info">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">

                            <label for="pay">الجامعات </label><br>
                            <select class="form-control qeno-select selectpicker" style="display:block;width:100% !important;" onchange="getcollege(this)" name="university_id" id="university" data-live-search="true">
                                <option value="0">اختر جامعه</option>
                                <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($university->id); ?>"><?php echo e($university->name_ar); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <script>
                                $(function() {
                                    $('.selectpicker').selectpicker();
                                });
                            </script>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="p">اسم الكليه </label>
                            <select id="college" class="form-control qeno-select selectpicker" style="display:block;width:100% !important;" name="college" data-live-search="true" onchange="getdivision(this)" required>
                                <option value="0" disabled="disabled" selected="selected">اختر كليه</option>
                                <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($college->id); ?>"><?php echo e($college->name_ar); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <script>
                                $(function() {
                                    $('.selectpicker').selectpicker();
                                });
                            </script>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>اسم القسم </label>
                            <select multiple class="form-control qeno-select selectpicker" style="display:block;width:100% !important;" data-live-search="true" id="division" name="division_id[]" onchange="getsection2()" required>
                                <option value="0" disabled="disabled">اختر قسم</option>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($division->id); ?>"><?php echo e($division->name_ar); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>اسم الفرقه </label>
                            <select name="section_id[]" multiple class="form-control qeno-select selectpicker" style="display:block;width:100% !important;" data-live-search="true" id="section" onchange="getsubcollege()" required>

                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($section->id); ?>"><?php echo e($section->name_ar); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label>العنوان </label>
                            <input type="text" class="form-control" placeholder="ادخل اسم " id="title" name="title">

                        </div>
                        <div class="form-group col-12">
                            <label> النص</label>
                            <input type="text" class="form-control" id="text" name="name_en">

                        </div>
                    </div>
                </div>




                <div class="save text-center mt-6">
                    <div class="row save">
                        <div class="col-12 text-center">
                            <input type="button" onclick="storenotification()" value="حفظ" class="text-center">

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--end setting-->
    <!--start foter-->
    <div class="foter">
        <div class="row">
            <div class="col-12 text-center">
                <h5>Made With <img src="<?php echo e(asset('images/red.svg')); ?>"> By Crazy Idea </h5>
                <p>Think Out Of The Box</p>
            </div>
        </div>
    </div>
    <!--end foter-->
</div>
</div>
<!--end page-body-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection("scripts"); ?>
<script>
    function storenotification() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'storeuniversitynotification',
            type: 'post',
            dataType: 'json',
            data: {
                'title': $("#title").val(),
                'text': $("#text").val(),
                'section_id': $("#section").val()
            },
            beforeSend: function() {
                Swal.fire(
                    'يتم الان ارسال الاشعارات',
                    'انتظر قليلا',

                )
            },
            success: function(result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم الاشعار بنجاح ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    location.reload();
                } else if (result.status == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,

                    })
                }
            }
        })
    }

    function getdivision(selected) {
        let id = selected.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getdivision/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                $('#division').empty();
                $('#division').html(result);
                $('#division').selectpicker('refresh');
            }

        });
    }

    function getsection2() {
        var selected = [];
        //  var division = [];
        // $.each($("#division"), function () {
        //     division.push( $(this).val());
        // });

        let division = $("#division").val();
        console.log(division);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: `getsection2`,
            type: "post",
            data: {
                "division": division
            },
            // contentType: "application/json; charset=utf-8",
            //   dataType: "Json",
            success: function(result) {
                $('#section').empty();
                $('#section').html(result);
                $('#section').selectpicker('refresh');
            }

        });
    }

    function getsubcollege() {

        let subcollege = $("#section").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: `getsubcollege2`,
            //  contentType: "application/json; charset=utf-8",

            data: {
                "subcollege": subcollege
            },
            success: function(result) {
                $('#subcollege').empty();
                $('#subcollege').html(result);
                $('#subcollege').selectpicker('refresh');
            }

        });
    }

    function getcollege(selected) {
        let id = selected.value;
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `getcolleges/${id}`,
            //    contentType: "application/json; charset=utf-8",
            //     dataType: "Json",
            success: function(result) {
                $('#college').empty();
                $('#college').html(result.data);
                $('#college').selectpicker('refresh');
                console.log(result);
            }

        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/notifications/senduniversitynotifications.blade.php ENDPATH**/ ?>