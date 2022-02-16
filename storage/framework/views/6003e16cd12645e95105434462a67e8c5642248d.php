
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
	.qeno-select .dropdown-toggle{
		    border: 1px solid #75757542 !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start;
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
                            <h5>اصرف النقاط</h5>
                        </div>
                            <form method="post" action="<?php echo e(route('storestupoints')); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                           
                        </div>
                        <div class="info">
                            <div class="row">
                          
                             
                     <div class="form-group col-lg-3 col-md-6 col-12">
                                     
                              <label for="pay">اكواد الطلاب</label><br >
                               <select class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;"
                               onchange="getstucode(this)" name="id" data-live-search="true">
                                 <option value="0">اختر كود</option>
                                       <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($student->id); ?>"><?php echo e($student->code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
                                   </select>
                                   <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                                   <input type="hidden" type="number"  value="1" disabled="disabled"
                                   name="point">
                                 
                               </div>
                               
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                   <label for="name">االاسم </label><br >
                                   <input id="name" style="height:35px;" type="text"  name="name">
                               </div>
                          <div class="form-group col-lg-3 col-md-6 col-12">
                                   <label for="phone">الهاتف </label><br >
                                   <input id="phone" style="height:35px;" type="text"  name="phone">
                               </div>
                         <div class="form-group col-lg-3 col-md-6 col-12">
                                   <label for="points">النقاط </label><br >
                                   <input id="points" style="height:35px;" type="number"  name="points">
                               </div>
                               <div class="form-group col-lg-3 col-md-6 col-12">
                                   <label for="money">المال </label><br >
                                   <input id="money" style="height:35px;" type="number"  name="money">
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
function getstucode(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getstucode/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
          $("#name").val(result.name);
          $("#phone").val(result.phone)
       }

      });
    }
   $('#points').keyup(function(){ 
 let id = $(this).val();
$.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getmoney/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $("#money").empty();
        $("#money").val(result);
       }
      });

   }); $('#money').keyup(function(){ 
 let id = $(this).val();
$.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getpoints/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $("#points").empty();
        $("#points").val(result);
       }
      });

   });

</script
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/pointscash.blade.php ENDPATH**/ ?>