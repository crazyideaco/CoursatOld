
<?php $__env->startSection('style'); ?>
<style>
.selectpicker{
   width: 100% !important;
    display:block !important;
}
.selectpicker button{
     width: 100% !important;  
}
.setting .info button{
    width: 100% !important;
    background-color:white;
}
</style>
<?php $__env->stopSection(); ?>
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
                            <h5>  اضافه كورس لطالب جامعى </h5>
                        </div>
                           
                           
                        </div>
                        <div class="info">
                            <div class="row">
                          
                             
                     <div class="form-group col-6">
                                     
                              <label for="pay">اكواد الطلاب</label><br >
                               <select class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" id="student"
                               onchange="gettypecollegecourse(this)" name="id" data-live-search="true">
                                 <option value="0" selected="selected" disabled>اختر كود</option>
                                       <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($student->id); ?>"><?php echo e($student->code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
                                   </select>
                                   <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                               </div>
                                 <div class="form-group col-6">
                                     
                              <label for="type"> الكورسات</label><br >
                               <select class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" id="type"
                                data-live-search="true">
                                 <option value="0">اختر كورس</option>
                                       <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($type->id); ?>"><?php echo e($type->name_ar); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
                                   </select>
                                   <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>                         
								</div>    
                            </div>
                  <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center" onclick="addtypecollegecourse()">

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
function gettypecollegecourse(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `gettypecollegecourse/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
          $("#type").empty();
          $("#type").html(result.data);
		   $("#type").selectpicker("refresh");
       }

      });
    }
  function addtypecollegecourse(){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: 'addtypecollegecourse',
       dataType: "Json",
		data:{
		'student_id':$('#student').val(),
		'type_id':$("#type").val()
		},
       success: function(result){
		   if(result.status == true){
			   Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم اضافه الطالب للكورس بنجاح',
  showConfirmButton: false,
  timer: 1500
})
		location.reload();
		   }else if(result.status == false){
			   Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: result.message
})
		   }
       }

      });
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/givetypecollegecourse.blade.php ENDPATH**/ ?>