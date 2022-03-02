<?php $__env->startSection('content'); ?>
<style>
	.setting .info button{
		width: 100% !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start;
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
                            <h5>اضافه اشتراك</h5>
                        </div>
                     
                           
                        </div>
                        <div class="info">
                            <div class="row">
                          <div class="form-group col-6">
                            <label>المدرسين</label>
                      <select class="form-control selectpicker" id="user_id" data-live-search="true"  required >
                        
                          <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($general->id); ?>"><?php echo e($general->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                           </div>
                           
                             <div class="form-group col-6">
                                    <label>الباقه </label>
                      <select name="paqa_id" id="paqa_id" class="form-control selectpicker w-100"  data-live-search="true" required >
                         
                          <?php $__currentLoopData = $paqa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($general->id); ?>"><?php echo e($general->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                           </div>
                    
                               
                               
                         
                            </div>
                        
                  
                    
                    
                    
                           

                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input onclick="storepaqasuser()" type="button"  value="حفظ" class="text-center">

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
<?php $__env->startSection('scripts'); ?>
<script>
	$('select').selectpicker();
function storepaqasuser(){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    let data = new FormData();

    data.append('user_id', $('#user_id').val());
    data.append('paqa_id', $('#paqa_id').val());
  
    $.ajax({
       type:"post",
       url: `storepaqasuser`,
       enctype: 'multipart/form-data',
       contentType: false,
        processData: false,
       dataType: "Json",
       data:data,
       success: function(result){
      if(result.status == true){
          Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم  اضافه الباقه للمدرس',
  showConfirmButton: false,
  timer: 1500
})
location.reload();
      }else if(result.status == false){
             Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: result.message,

})
      }
       }

      });
    }</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/addpaqabasic.blade.php ENDPATH**/ ?>