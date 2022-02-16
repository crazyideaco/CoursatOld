
<?php $__env->startSection('style'); ?>
<style>
    #example_wrapper{
        width: 100% !important;
    }
	.all-products #btn1{
		margin-right: 0 !important;
	}
	.all-products #btn2{
		margin-right: 0 !important;
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
                <div class="setting all-products typs">
                    <div class="container">
                        <div class="row def">

                            <img src="images/all-products.svg">
                     <h5>الدورات التعلميه الشهريه </h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                    <button class="btn" style="width: fit-content">
                                      <a href="<?php echo e(route('addtype')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة دوره  تعلميه شهريه 
                                        </a>
                                    </button>

                            </div>

                        </div>



                        <div class="pt-5">
                          <div class="row">
                               <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>المرحله</label>
                            <select class="form-control selectpicker" name="stage_id" onchange="getstage(this)">
                                 <option value="0" selected="selected" required disabled="disabled">ادخل المرحله</option>
                                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($stage->id); ?>'><?php echo e($stage->name_ar); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                                 <?php $__errorArgs = ['stage_id'];
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
                           <label>سنه الماده</label>
                            <select class="form-control selectpicker" name="years_id" required id="year" onchange="getyear(this)">
                                <option value="0" selected="selected" disabled="disabled">اختر السنه</option>
                              
                            </select>
                                 <?php $__errorArgs = ['years_id'];
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
                           <label>الماده </label>
                            <select class="form-control selectpicker" name="subjects_id" required id="subject" onchange="getteacher(this)">
                                  <option value="0" selected="selected" disabled="disabled">اختر الماده</option>
                                
                            </select>
                                 <?php $__errorArgs = ['subjects_id'];
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
                            
                            <div class="form-group col-lg-3 col-md-6 col-12 d-flex justify-content-center align-items-center flex-column">
                              <label style="opacity: 0" class="w-100 d-block">الماده </label>
                            	<span class="btn btn-primary d-block" onclick="filtertypes()">بحث</span>    
                            </div>
                          </div>
                            <div class="row">
                                                    
         <table id="example" class="table col-12 table-responsive" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">الدوره االتعلميه الشهريه</th>
                        <th scope="col" class="text-center"> المدرس</th>
                        
                    <th scope="col">الماده</th>
                       <th scope="col" class="text-center">السنه</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody id="types">
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="type<?php echo e($type->id); ?>">
						  <td class="text-center"><?php echo e($type->id); ?></td>
                    <td scope="row" class="text-center"><a href="<?php echo e(route('subtypes',$type->id)); ?>"><?php echo e($type->name_ar); ?></a></td>
                      <td class="text-center">
                        <?php if($type->user): ?><?php echo e($type->user->name); ?>

                      <?php endif; ?></td>
                        <td class="text-center">
                          <?php if($type->subject): ?>
                          <?php echo e($type->subject->name_ar); ?>

                      <?php endif; ?></td>
                          <td class="text-center">
                            <?php if($type->year): ?>
                            <?php echo e($type->year->year_ar); ?> 
                      <?php endif; ?></td>
                        <td class="text-center">
                          <a href="<?php echo e(route('edittype',$type->id)); ?>" > <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                            <?php if(auth()->user()->hasPermission("types-delete")): ?>  
                             <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletetype('<?php echo e($type->id); ?>')" style="cursor:pointer;"> 
                          <?php endif; ?>
                         <span class="btn bg-success btn-success text-white btn-sm" id="btn<?php echo e($type->id); ?>" onclick="activetype(<?php echo e($type->id); ?>)">
                             <?php if($type->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                            
                         </span>
                           <a href="<?php echo e(route('grouptypes',$type->id)); ?>" class="btn btn-success btn-sm" >المجموعات</a>
                           <a href="<?php echo e(route('studentstype',$type->id)); ?>" class="btn btn-success btn-sm" >الطلاب</a>
                           <a href="<?php echo e(route('typeexams',$type->id)); ?>" class="btn btn-success btn-sm" >الامتحانات</a>
                                            </td>
                                        </tr>                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
    </table>
                             
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
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  

<script>
    $(document).ready(function() {
    $('#example').DataTable({
	"order": [[ 0, "desc" ]], // Order on init. # is the column, starting at 0});
  columnDefs: [
      {
          targets: 0,
        visible : false,
        
     
      },]
           
});
	});
function activetype(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activetype/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    if(result.status == 'deactive'){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم الغاء التفعيل ',
  showConfirmButton: false,
  timer: 1500
});
$(`#btn${id}`).html('تفعيل');

    }else if(result.status == 'active'){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم التفعيل  ',
  showConfirmButton: false,
  timer: 1500
});
$(`#btn${id}`).html('الغاء التفعيل');

    }
    
       }

      });
  } function deletetype(sel){
    let id = sel;
 
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
     Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
       type:"get",
       url: `deletetype/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#type${id}`).remove();
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
         )
       }
           }
        
    });
    }
   
   
  })
}
	function getstage(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getstage/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#year').empty();
    $('#year').html(result);
        $('#year').selectpicker('refresh');
       }

      });
    }
    	function getyear(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getyear/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#subject').empty();
    $('#subject').html(result);
        $('#subject').selectpicker('refresh');
       }

      });
    }
    function filtertypes(){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filtertypes`,
      //   contentType: "application/json; charset=utf-8",
       dataType: "Json",
      data:{
        "years_id":$("#year").val(),
        "subjects_id":$("#subject").val(),
       
      },
       success: function(result){
    if(result.status == true){
        $('#example').DataTable().destroy();
$("#types").empty();
      $("#types").append(result.data);
       $('#example').DataTable().draw();
    }
    
       }

      });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/types.blade.php ENDPATH**/ ?>