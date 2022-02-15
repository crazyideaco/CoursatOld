
<?php $__env->startSection('content'); ?>
<style>
	.studentprofile img{
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            width: 70%;
        }
        .studentprofile h4{
            display: flex;
            justify-content: center;
            margin: 5% 0 0;
        }
        .studentprofile h5{
            display: flex;
            justify-content: center;
            margin: 2% 0;
        }
        .studentprofile p{
            margin-right: 2%;
            margin-left: 2%;
        }
	.studentprofile .fl{
		margin-top: 5%;
		box-shadow: 0 5px 5px 5px #d5d5d573;
    	padding: 5%;
	}
	.studentprofile .img{
		position: absolute;
		top: 15%;
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

       <?php 
				$student = \App\User::where('id',$id)->first();
				?>
                <!--start setting-->
                <div class="col-12 studentprofile">
	<div class="row fl bg-white">
        <div class="col-3">
            <div class="img">
				<?php if($student->image): ?>
                <img src="<?php echo e(url('uploads/'.$student->image)); ?>">
				<?php endif; ?>
                <p> <?php echo e($student->name); ?></p>
                <p> <?php echo e($student->code); ?></p>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <h6>الايميل:</h6>
                <p><?php echo e($student->email); ?></p>
            </div>
			<div class="row">
                <h6>التليفون:</h6>
                <p><?php echo e($student->phone); ?></p>
            </div>
			<?php if($student->category_id == 1): ?>
			<div class="row">
                <h6 for="year">السنة:</h6>
              <p>
              <?php if($student->year): ?>
                <?php echo e($student->year->year_ar); ?>

              <?php endif; ?></p>
            </div>
			<div class="row">
                <h6 for="year">المرحله:</h6>
               <p>
                <?php if($student->stage): ?>
               <?php echo e($student->stage['stage_ar']); ?>

              <?php endif; ?>
                 </p>
            </div>
			<?php endif; ?>
			<?php if($student->category_id == 2): ?>
			<div class="row">
                <h6 for="year">الجامعه:</h6>
				<?php if($student->university): ?>
                <p><?php echo e($student->university['name_ar']); ?></p>
				<?php endif; ?>
            </div>
			<div class="row">
                <h6 for="year">الكليه:</h6>
					<?php if($student->college): ?>
                <p><?php echo e($student->college['name_ar']); ?></p>
				<?php endif; ?>
            </div>
			<div class="row">
                <h6 for="year">السنه:</h6>
				<?php if($student->division): ?>
                <p><?php echo e($student->division['name_ar']); ?></p>
				<?php endif; ?>
            </div><div class="row">
                <h6 for="year">الفرقه:</h6>
			<?php if($student->section): ?>
                <p><?php echo e($student->section['name_ar']); ?></p>
			<?php endif; ?>
            </div>
          
			<?php endif; ?>
            <div class="row">
                <h6>المحافظة:</h6>
				<?php if($student->state): ?>
                <p><?php echo e($student->state['state']); ?></p>
				<?php endif; ?>
            </div>
            <div class="row">
                <h6>المدينة:</h6>
               <?php if($student->city): ?>
                <p><?php echo e($student->city['city']); ?></p>
				<?php endif; ?>
            </div>
           
            <div class="row">
                <h6>النقاط:</h6>
                <p><?php echo e($student->points); ?></p>
            </div>
            <div class="row">
                <h6>الوصف:</h6>
                <p><?php echo e($student->description); ?> </p>
            </div>
          <?php if($student->category_id == 1): ?>
           <div class="row">
                <h6>عدد الكورسات:</h6>
                <p><?php echo e(count($student->stutypes)); ?> </p>
            </div>
           <div class="row">
                <h6>الكورسات :</h6>
                <p>
                  <?php if($student->stutypes): ?>
                  <?php echo e(implode('-',$student->stutypes->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div> <div class="row">
                <h6>المجموعات :</h6>
                <p>
                  <?php if($student->groupstype): ?>
                  <?php echo e(implode('-',$student->groupstype->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div>
          <?php elseif($student->category_id == 2): ?>
           <div class="row">
                <h6>عدد الكورسات:</h6>
                <p><?php echo e(count($student->stutypescollege)); ?> </p>
            </div>
            <div class="row">
                <h6>الكورسات :</h6>
                <p>
                  <?php if($student->stutypescollege): ?>
                  <?php echo e(implode('-',$student->stutypescollege->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div>
          <div class="row">
                <h6>المجموعات :</h6>
                <p>
                  <?php if($student->groupstype): ?>
                  <?php echo e(implode('-',$student->groupstypescollege->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div>
          <?php elseif($student->category_id == 3): ?>
           <div class="row">
                <h6>عدد الكورسات:</h6>
                <p><?php echo e(count($student->stucourses)); ?> </p>
            </div>
            <div class="row">
                <h6>الكورسات :</h6>
                <p>
                  <?php if($student->stutypescollege): ?>
                  <?php echo e(implode('-',$student->stucourses->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div>
          <div class="row">
                <h6>المجموعات :</h6>
                <p>
                  <?php if($student->groupstype): ?>
                  <?php echo e(implode('-',$student->groupscourse->pluck('name_ar')->toArray())); ?>

             <?php endif; ?></p>
            </div>
          <?php endif; ?>
          
          <div class="row">
                <h6 for="year">تابع الى :</h6>
					<?php if($student->stdcenters): ?>
                <p>
                     <?php echo e(implode('-',$student->stdcenters->pluck('name')->toArray())); ?>

            </p>
				<?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcours/public_html/resources/views/dashboard/studentprofile.blade.php ENDPATH**/ ?>