
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

                            <img src="images/all-products.svg">
                            <h5>المواد</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <button class="btn w-100 mx-auto" >
                                      <a href="<?php echo e(route('addsubcollege')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافه ماده  
                                        </a>
                                    </button>

                     



                                <div class="col-4">

                                </div>

                                



                                </div>

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                      <div class="table-responsive">
                                                  
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<td >id</td>
                    <td scope="col" class="text-center">اسم الماده</td>
                         <th scope="col" class="text-center">الفرقه</th>
                    <td scope="col" class="text-center">القسم</td>
                
                     <th scope="col" class="text-center">اسم الجامعه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="un<?php echo e($subcollege->id); ?>">
						     <td scope="row" class="text-center">
                   <?php echo e($subcollege->id); ?></td>
                          <td scope="row" class="text-center">
                   <?php echo e($subcollege->name_ar); ?></td>
                   <td scope="row" class="text-center">
                   <?php echo e($subcollege->section->name_ar); ?></td>
                <td scope="row" class="text-center">
                   <?php echo e($subcollege->division->name_ar); ?></td>
                       <td class="text-center"><?php echo e($subcollege->university->name_ar); ?></td>
                    <td class="text-center"><?php echo e($subcollege->college->name_ar); ?></td>
                        <td class="text-center">
                  <a href="<?php echo e(route('editsubcollege',$subcollege->id)); ?>"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>	
                              <?php if(auth()->user()->hasPermission("subcolleges-delete")): ?>
                          <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletesubcollege('<?php echo e($subcollege->id); ?>')" style="cursor:pointer;"> 
                          <?php endif; ?>
							 <a href="<?php echo e(route('subjectscollegequestions',$subcollege->id)); ?>" class="btn btn-success btn-sm" >الاسئله</a>
                                            <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px" id="btning<?php echo e($subcollege->id); ?>" onclick="activesubject(<?php echo e($subcollege->id); ?>)">
                             <?php if($subcollege->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                         </span>
                                            </td>
                                        </tr>                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
    </table>
                             
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
	});  function deletesubcollege(sel){
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
       url: `deletesubcollege/${id}`,
   //    contentType: "application/json; charset=utf-8",
//       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#un${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الماده بنجاح',
      'success'
         )
       }
           }
        
    });
    }
   
   
  })
}function activesubject(id1){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../activesubject`,
        data:{
        'id':id1,
        'status' :1
      },
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
$(`#btning${id1}`).html('تفعيل');

    }else if(result.status == 'active'){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم التفعيل  ',
  showConfirmButton: false,
  timer: 1500
});
$(`#btning${id1}`).html('الغاء التفعيل');

    }
    
       }

      });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/subcolleges.blade.php ENDPATH**/ ?>