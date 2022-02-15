
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
                            <h5>اضافه طلاب للمجموعه </h5>
                        </div>
                       <form method="post" action="<?php echo e(route('storegroupstypescollegestudent',$group->id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                        <div class="info">
                
                         
                            <div class="row">
                               <div class="form-group col-6">
                                     
                              <label for="pay"> الطلاب</label><br >
                               <select class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" id="student" multiple
                               name="students[]" data-live-search="true">
                            <!---     <option value="0" selected="selected" disabled>اختر كود</option>-->
                                       <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($student->id); ?>" <?php if(in_array($student->id,$group->students->pluck('id')->toArray())): ?> selected <?php endif; ?>><?php echo e($student->name); ?></option>
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
                                  <input type="submit"  value="حفظ"  style="cursor:pointer;" class="text-center">
                                </div>
                            </div>
                        </div>
                  </form>
                    </div>
                </div>
            </div>
             <!--</form>-->
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
       
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}

 function getteacher2(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result[0]);
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}

 function getteacher3(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[1]);
        
       }

      });
}
 function gettype(selected){
var value=document.getElementById("subject").value;

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `gettype/${id}/${value}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       
        $('#type').empty();
        $('#type').html(result[0]);
        
       }

      });
} 

</script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/groupstypecollegestudents/create.blade.php ENDPATH**/ ?>