
<?php $__env->startSection('content'); ?>
<style>
	#checkAll{
      width: unset;
      transform: scale(1.5);
    }
  	.setting .info input{
      width: unset;
    }
  .info .inputDetails input{
    width: 100%;
  }
  
	/* ====== Tablet style ====== */
	@media  only screen and (max-width: 991.98px){
      .nav-tabs .nav-item{
			width: 16%;
      }
      .nav-tabs .nav-link{
        text-align: center;
      }
      .tab-content{
        margin-top: 5%;
      }
      .form-check-inline{
        width: 22.5%;
      }
      .notifcation .nav-item{
          width: 25%;
        }
    /* ====== Mobile style ====== */

      @media  only screen and (max-width: 767.98px) {
        .nav-tabs .nav-item{
			width: 33%;
      	}
        .form-check-inline {
    		width: 45.5%;
		}
        .notifcation .nav-item{
          width: 45.5%;
        }
        .notifcation{
          margin-top: 10%;
        }
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
                            <h5>تعديل ادمن </h5>
                        </div>
                            <form method="post" action="<?php echo e(route('updateadmin',$admin->id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                        <div class="info">
                            <div class="row inputDetails ">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>الاسم</label>
                                    <input class="form-control" value="<?php echo e($admin->name); ?>"  type="text" name="name">
                                    <?php $__errorArgs = ['name'];
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
                                    <label>الايميل</label>
                                    <input class="form-control" value="<?php echo e($admin->email); ?>"  type="text" name="email">
                                    <?php $__errorArgs = ['email'];
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
                                    <label>كلمه السر</label>
                                    <input class="form-control" type="password" name="password">
                                    <?php $__errorArgs = ['password'];
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
                                    <label>الهاتف</label>
                                    <input class="form-control" value="<?php echo e($admin->phone); ?>"  type="text" name="phone">
                                    <?php $__errorArgs = ['phone'];
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
                            <?php
           $models = ['admins',
            'teachers',
            'doctors',
            'lecturer',
            'centers',
            'states',
            'cities',
            'offers' ,
       
          // 'points',
          // 'pointscash' ,
          // 'messages' ,
            'stages',
            'years',
            'subjects',
          'types' ,
          'subtypes' ,
          'videos' ,
      //   'userpaqa' ,
          'subjectquestionsscenter',
          'universities',
          'colleges',
          'divisions',
           'sections', 
          'subcolleges',
           'typescolleges',
           'lessons', 
          'videoscolleges',
          'subjectscollegequestionscenter',
           'general',
           'sub',
           'course', 
          'videosgeneral',
          'subquestioncenterss',
        'paqas' ,
         // 'students'
                          ];
                                $maps = ['create','read','update','delete'];
                          $models1 = [     'sendnotification' ,
             'sendnotificationbasic' ,
           'sendnotificationuniversity' ,
           'sendnotificationgeneral' ];
                          $maps1 =  ['create'];
                            ?>
							
                          	<div class="col-12">
                              	
                               <div class="mb-3">
                          		<label><input type="checkbox" class="formcotrol ml-3 mr-3" id="checkAll" >كل الصلاحيات</label>
                          	</div>
                          </div>
                            <div class="col-xl-12">
                                <label class="mb-3">الصلاحيات</label>
                                <ul class="nav nav-tabs">
                                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a href="#<?php echo e($model); ?>" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>">
                                            <span><?php echo e(__('messages.'.$model)); ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                                <div class="tab-content">
                                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div role="tabpanel" class="tab-pane fade show <?php echo e($index == 0 ? 'active' : ''); ?>" id="<?php echo e($model); ?>">
                                        <?php $__currentLoopData = $maps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $map): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="checkbox checkbox-success form-check-inline">
                                                <input type="checkbox" name="permissions[]" id="inlineCheckbox<?php echo e($key); ?>" value="<?php echo e($model); ?>-<?php echo e($map); ?>" <?php if($admin->hasPermission($model .'-'.$map)): ?>  checked <?php endif; ?>>
                                                <label for="inlineCheckbox<?php echo e($key); ?>" style="margin-right: 30px;"> <?php echo e(__('messages.'.$map)); ?></label>
                                            </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <ul class="nav nav-tabs notifcation">
                                    <?php $__currentLoopData = $models1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a href="#<?php echo e($model); ?>" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>">
                                            <span><?php echo e(__('messages.'.$model)); ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                                <div class="tab-content">
                                    <?php $__currentLoopData = $models1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div role="tabpanel" class="tab-pane fade show <?php echo e($index == 0 ? 'active' : ''); ?>" id="<?php echo e($model); ?>">
                                        <?php $__currentLoopData = $maps1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $map): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="checkbox checkbox-success form-check-inline">
                                                <input type="checkbox" name="permissions[]" id="inlineCheckbox<?php echo e($key); ?>" value="<?php echo e($model); ?>-<?php echo e($map); ?>" <?php if($admin->hasPermission($model .'-'.$map)): ?>  checked <?php endif; ?>>
                                                <label for="inlineCheckbox<?php echo e($key); ?>" style="margin-right: 30px;"> <?php echo e(__('messages.'.$map)); ?></label>
                                            </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div><!-- end col -->
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
<script>
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/admins/editadmin.blade.php ENDPATH**/ ?>