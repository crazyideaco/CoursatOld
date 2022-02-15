
<?php $__env->startSection('content'); ?>
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
                            <h5>تعديل فرقه </h5>
                        </div>
                            <form method="post" action="<?php echo e(route('updatesection',$section->id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                         
                                    
                               
                       
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                     <label>اسم الفرقه بالعربى  </label>
                                    <input class="form-control" type="text" name="name_ar" value="<?php echo e($section->name_ar); ?>">
									  <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="color:red;"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                  <div class="form-group col-lg-3 col-md-6 col-12">
                                     <label>اسم الفرقه بالانجليزي  </label>
                                    <input class="form-control" type="text" name="name_en" value="<?php echo e($section->name_en); ?>">
									    <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="color:red;"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" class="form-control" onchange="getcolleges(this)">
                                       <option value="0" disabled="disabled" selected="selected">اختر جامعه</option>
                                       <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($university->id); ?>"
                                       <?php if($section->university_id == $university->id): ?>
                                       selected <?php endif; ?>><?php echo e($university->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                    <?php $__errorArgs = ['university_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="color:red;"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="0" disabled="disabled" selected="selected">اختر كليه</option>
                                       <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($college->id); ?>" <?php if($section->college_id == $college->id): ?>
                                       selected <?php endif; ?>
                                       ><?php echo e($college->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
									   <?php $__errorArgs = ['college_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="color:red;"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" class="form-control" id="division">
                                       <option value="0" disabled="disabled" selected="selected">اختر قسم</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>" <?php if($section->division_id == $division->id): ?> 
                                       selected <?php endif; ?>><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
									   <?php $__errorArgs = ['division_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="color:red;"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                               
                            </div>
                         
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                    </form>
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
    function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
       }

      });
  }function getcolleges(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       console.log(result);
       }

      });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/editsection.blade.php ENDPATH**/ ?>