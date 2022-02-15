
<?php $__env->startSection('content'); ?>
<style>
	.setting .info button{
		width: 100% !important;
		background-color:#fff;
		border: 1px solid #75757542 !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option{
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
                            <h5> تعديل المعلومات </h5>
                        </div>
						<?php 
						$user = auth()->user();
						?>
                      <?php if(session()->has('success')): ?>
                      <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong><?php echo e(session()->get('success')); ?>

</div>
                      <?php endif; ?>
                     <form method="post" action="<?php echo e(route('storeyourinformation')); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                         
                                    
                                <div class="row">
                            <div class="col-lg-3 col-md-6 col-12 text-center set-img">
								
                               <img src="<?php echo e(asset('uploads/'.$user->image)); ?>" id="realimg">
								
                    <br>
                               <input id="ad" type="file" class="form-control ehabtalaat"  name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                 <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                 <p style="color:red;"><?php echo e($message); ?></p>
                                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div><div class="col-lg-3 col-md-6 col-12 text-center set-img">
                                <img src="<?php echo e(asset('uploads/'.$user->cover_image)); ?>" id="realimg3">
                    <br>
                               <input id="ad3" type="file" class="form-control ehabtalaat"  name="cover_image">
                                        <label for="ad3" class="ahmed">اضافة cover </label>
                                 <?php $__errorArgs = ['cover_image'];
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
									<div class="col-lg-3 col-md-6 col-12 text-center set-img">

                               <img src="<?php echo e(asset('uploads/'.$user->printsplash)); ?>" id="realimg2">
										
                    <br>
                               <input id="ad2" type="file" class="form-control ehabtalaat"  name="printsplash">
                                        <label for="ad2" class="ahmed">اضافة print splash</label>
                                 <?php $__errorArgs = ['printsplash'];
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
                               <div class="col-lg-3 col-md-6 col-12 text-center mb-5 set-img">
								   
                    <video width="200" height="200" controls >
					
              <source src="<?php echo e(asset('uploads/'.$user->intro)); ?>" id="video_here">
            Your browser does not support HTML5 video.
          </video>
								   
          <br>
          <br>
                   <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
                            <label for="kt" class="ahmed">اضافة فيديو</label>
                            <?php $__errorArgs = ['intro'];
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
                   
                        <div class="info">
                         
                                  
                            <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>المحافظة</label>
                      <select name="state_id" class="form-control" onchange="getcity(this)">
                          <option value="state_id" selected="selected" disabled>اختر محافظه</option>
                          <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($state->id); ?>" <?php if(auth()->user()->state_id == $state->id): ?>
							  selected <?php endif; ?>><?php echo e($state->state); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                          </div>
                             <div class="form-group col-md-4 col-12">
                                 <label>المدينة</label>
                      <select name="city_id" class="form-control" id="city">
                         <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($city->id); ?>" <?php if(auth()->user()->city_id == $city->id): ?>
							  selected <?php endif; ?>><?php echo e($city->city); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                          </select>
                          </div>
                           <div class="form-group col-md-4 col-12">
                               <label>العنوان</label>
                               <input type="text" name="address" value="<?php echo e(auth()->user()->address); ?>" class="form-control">
                           </div>
                           
                         
                         </div>
                         <div class="row">
                        <div class="form-group col-12">
                                   <label>الوصف</label>
                                   <textarea class="form-control" rows="5" name="description"><?php echo e(auth()->user()->description); ?></textarea>
                              
                           
                            </div>
</div>
                            <br><br>
                         <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

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
   $('form').ajaxForm({
      beforeSend:function(){
        $('#success').empty();
      },
      uploadProgress:function(event, position, total, percentComplete)
      {
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
        if(data.errors)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          $('#success').html('<div class="text-danger"><b>'+data.errors+'</b></div>');
        }
        if(data.success)
        {
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
       location.reload();
        }
      }
    });
    function getyear(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getyear/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#subject').empty();
        $('#subject').html(result);
        
       }

      });
}
  function getteacher(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result);
        
       }

      });
}

function getcity(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcity/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#city').empty();
       $('#city').html(result);
       console.log(result);
       }

      });
    }

function getsub(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsub/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#sub').empty();
       $('#sub').html(result);
		    $('#sub').selectpicker("refresh");
       console.log(result);
       }

      });
    }
$(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
}); function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad").change(function(){
    readURL(this);
});function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad2").change(function(){
    readURL2(this);
});function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad3").change(function(){
    readURL3(this);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/edityourinformation.blade.php ENDPATH**/ ?>