
<?php $__env->startSection('style'); ?>
<style>
    #example_wrapper{
        width: 100% !important;
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

                            <img src="<?php echo e(asset('images/all-products.svg')); ?>">
                            <h5>حصص</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-3">
                                    <button class="btn" >
                                      <a href="<?php echo e(route('addlesson',$id)); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافه حصه  
                                        </a>
                                    </button>

                     
                              </div>


                                <div class="col-4">

                                </div>

                                
   <div class="col-3">
                                    <button class="btn" >
                                      <a href="<?php echo e(route('addspecialcollege',$id)); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                           اضافه حصه مخصصه
                                        </a>
                                    </button>

                     
                              </div>



                                </div>

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<td>id</td>
                      <td scope="col" class="text-center">اسم الحصه</td>
                    <td scope="col" class="text-center">اسم الكورس</td>
                    <td scope="col" class="text-center">اسم الماده</td>
                    <td scope="col" class="text-center">القسم</td>
                     <th scope="col" class="text-center">الفرقه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                      <th scope="col" class="text-center">اسم الجامعه</th>
                  <th scope="col" class="text-center">رقم الحصه </th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
						 <tr id="un<?php echo e($lesson->id); ?>">
						 <td scope="row" class="text-center">
                   <?php echo e($lesson->id); ?></td>
                          <td scope="row" class="text-center">
                             <?php if($lesson->status == 0): ?> 
                            <a href="<?php echo e(route('videoscolleges',$lesson->id)); ?>">
                   <?php echo e($lesson->name_ar); ?></a>
                           <?php else: ?>
                             <?php echo e($lesson->name_ar); ?>

                            <?php endif; ?>
                           </td>
                          <td scope="row" class="text-center">
                   <?php echo e($lesson->typescollege->name_ar); ?></td>
                   <td scope="row" class="text-center">
                   <?php echo e($lesson->subjectscollege->name_ar); ?></td>
                   <td scope="row" class="text-center">
                   <?php echo e($lesson->section->name_ar); ?></td>
                <td scope="row" class="text-center">
                   <?php echo e($lesson->division->name_ar); ?></td>
                    <td class="text-center"><?php echo e($lesson->college->name_ar); ?></td>
                      <td class="text-center"><?php echo e($lesson->university->name_ar); ?></td>
                           <td class="text-center"><?php echo e($lesson->order_number); ?></td>
                        <td class="text-center">
                              <?php if($lesson->status == 0): ?> 
                  <a href="<?php echo e(route('editlesson',$lesson->id)); ?>" class="d-block"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                          <?php else: ?>
                           <a href="<?php echo e(route('editspecialcollege',$lesson->id)); ?>" class="d-block"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                          <?php endif; ?>
                          <span class="btn btn-success btn-sm d-block" id="btn<?php echo e($lesson->id); ?>" onclick="activelesson(<?php echo e($lesson->id); ?>)">
                             <?php if($lesson->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                         </span>
                                 <a class="btn btn-primary btn-sm mt-2" href="<?php echo e(route('lessonexams',$lesson->id)); ?>">
                          الامتحانات
                         </a>
                              <?php if(auth()->user()->hasPermission("lessons-delete")): ?>
									 <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletelesson('<?php echo e($lesson->id); ?>')" style="cursor:pointer;"> 
                          <?php endif; ?>
                          <a href="<?php echo e(route('lessonattendstudents',$lesson->id)); ?>"  class="btn btn-success btn-sm mt-2" >الحاضرين</a>
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
  function activelesson(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activelesson/${id}`,
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
  }function deletelesson(sel){
    let id = sel;
 
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
     Swal.fire({
  title: 'هل انت متاكد',
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
       url: `../deletelesson/${id}`,
   //    contentType: "application/json; charset=utf-8",
//       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#un${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الحصه بنجاح',
      'success'
         )
       }
           }
        
    });
    }
   
   
  })
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/lessons.blade.php ENDPATH**/ ?>