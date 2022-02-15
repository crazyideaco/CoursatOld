
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
                            <h5>الطلاب</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                   

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                 <div class="table-responsive">
                                                      
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">الاسم</th>
					<th scope="col" class="text-center">الكود</th>
					<th scope="col" class="text-center">المحافظه</th>
					<th scope="col" class="text-center">المدينه</th>
                  
                <!--  <th scope="col" class="text_center">السنه</th>-->
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="s<?php echo e($student->id); ?>">
                      
						<th><?php echo e($student->id); ?></th>
                      <td scope="col" class='text-center'><a href="<?php echo e(route('studentprofile',$student->id)); ?>"><?php echo e($student->name); ?></a></td>
				<td scope="col" class='text-center'><?php echo e($student->code); ?></td>
             <td scope="col" class="text-center">
                <?php if($student->state): ?>     
                   <?php echo e($student->state['state']); ?>

				 <?php endif; ?>
                  </td>   
						<td scope="col" class="text-center">
                     <?php if($student->city): ?>
                   <?php echo e($student->city['city']); ?>

						<?php endif; ?>
                  </td>     
					<td class="text-center">
                               <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px" id="btn<?php echo e($student->id); ?>" onclick="activeuser(<?php echo e($student->id); ?>)">
                             <?php if($student->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                         </span>
                             <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deleteuser('<?php echo e($student->id); ?>')" style="cursor:pointer;"> 
                       <?php if($student->category_id == 1): ?>
                          <a class="btnbtn-sm mt-2"    style="border:1px solid #222; margin-bottom:10px; font-size:13px; display:block;    padding: 10px 10px;
 width: 60%;
 "
 href="<?php echo e(route('typeresults_students',$student->id)); ?>">نتائج الامتحانات</a>
                          <?php elseif($student->category_id == 2): ?>
                            <a class="btn btn-sm mt-2"     style="border:1px solid #222; margin-bottom:10px; padding:6px 20px"
 href="<?php echo e(route('typecollegeresults_students',$student->id)); ?>">نتائج الامتحانات</a>
                          <?php endif; ?>
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
    "order": [[ 0, "desc" ]],
			"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
            },
        ]// Order on init. # is the column, starting at 0

});
	});function activeuser(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activeuser/${id}`,
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
  }  function deleteuser(sel){
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
 
       url: `deleteuser/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#s${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح المستخدم بنجاح',
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
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/students.blade.php ENDPATH**/ ?>