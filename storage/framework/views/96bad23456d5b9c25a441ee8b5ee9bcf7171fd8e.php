
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
                            <h5>المجموعات</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <button class="btn mx-auto w-100" >
                                  <a href="<?php echo e(route('addgrouptype',$id)); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة مجموعه  
                                        </a>
                                    </button>
                              </div>
                     



                                <div class="col-4">

                                </div>

                                  

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                         <div class="table-responsive">        
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">المجموعه</th>
                    <th scope="col">الماده</th>
                       <th scope="col" class="text-center">السنه</th>
              <th scope="col" class="text-center">الدوره التعلميه الشهريه</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
          <tbody>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="group<?php echo e($group->id); ?>">
                  
						  <td class="text-center"><?php echo e($group->id); ?> </td>
                    <td  class="text-center">
                      
                 
                      <?php echo e($group->name_ar); ?>

                   </td>
                        <td class="text-center"><?php echo e($group->subject->name_ar); ?> </td>
                          <td class="text-center"><?php echo e($group->year->year_ar); ?> </td>
                           <td class="text-center"><?php echo e($group->type->name_ar); ?> </td>
                    
                     
                        <td class="text-center">
                     
                     
                                <a href="<?php echo e(route('editgrouptype',$group->id)); ?>" > <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                      
                           <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletegroup('<?php echo e($group->id); ?>')" style="cursor:pointer;"> 
                     <a href="<?php echo e(route('grouptypelivelessons',$group->id)); ?>" class="btn btn-success btn-sm" >حصص لايف</a>
                          
                           <a href="<?php echo e(route('grouptypestudents',$group->id)); ?>" class="btn btn-success btn-sm" >الطلاب </a>
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
//   $(document).ready(function() {
    $('#example').DataTable({
	"order": [[ 0, "desc" ]], // Order on init. # is the column, starting at 0});
  columnDefs: [
      {
         targets: 0,
      visible : false,
        
     
      },]
           
});
//	});
function deletegroup(sel){
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
       url: `../deletegrouptype/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#group${id}`).remove();
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/groupstypes/index.blade.php ENDPATH**/ ?>