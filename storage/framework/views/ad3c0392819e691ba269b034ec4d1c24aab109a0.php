
<?php $__env->startSection('style'); ?>
<style>
    #example_wrapper{
        width: 100% !important;
    }
    .all-products button {
    width: 81px !important;
    color: #ffffff;
     font-family: 'light' !important;
    font-size: 19px !important;
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
                            <h5>  طلبات الانضمام</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                
                     



                                <div class="col-4">

                                </div>

                                  

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">اسم الطالب</th>
                     <th scope="col" class="text-center"> الكورس</th>
                      <th scope="col" class="text-center"> الاعدادات</th>
                </tr>
                        </thead>
          <tbody>
              <?php $__currentLoopData = $joins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $join): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="join<?php echo e($join->id); ?>">
        <td class="text-center"><?php echo e($join->id); ?></td>
        <td class="text-center"><?php echo e($join->student->name ?? ""); ?></td>
        <td class="text-center"><?php echo e($join->typescollege->name_ar ?? ""); ?></td>
        <td class="tex-center">
        <div id="status<?php echo e($join->id); ?>">
            <?php if($join->status == 0): ?>
          
        <button type="button"  class="btn btn-success
         btn-light-success w-30" onclick="accept_typecollege_join(<?php echo e($join->id); ?>)">
                           قبول </button>
                           <button type="button"  class="btn btn-danger
         btn-light-danger w-30 "  onclick="refuse_typecollege_join(<?php echo e($join->id); ?>)">
                           رفض </button>
            
            <?php elseif($join->status == 1): ?>
            <span class="badge badge-success p-2">تم القبول</span>
            <?php elseif($join->status == 2): ?>
            <span class="badge badge-danger p-2">تم الرفض</span>
                           <?php endif; ?>
                           </div>
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
//   $(document).ready(function() {
    $('#example').DataTable({
	"order": [[ 0, "desc" ]], // Order on init. # is the column, starting at 0});
  columnDefs: [
      {
         targets: 0,
      visible : false,
        
     
      },]
           
});
function accept_typecollege_join(sel){
    let id = sel;
 
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `accept_typecollege_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
      result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-success p-2">تم القبول</span>');
       }
           }
        
    });
    }function refuse_typecollege_join(sel){
    let id = sel;
 
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `refuse_typecollege_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
         result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-danger p-2">تم الرفض</span>');
       }
           }
        
    });
    }
 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/typecollege_joins/index.blade.php ENDPATH**/ ?>