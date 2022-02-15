
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
  <input type="hidden" value="<?php echo e($status); ?>" id="status">

                <!--start setting-->
                <div class="setting all-products typs">
                    <div class="container">
                        <div class="row def">

                            <img src="<?php echo e(asset('images/all-products.svg')); ?>">
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
                               <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px" id="btn<?php echo e($student->id); ?>" onclick="deletestudentcourse(<?php echo e($student->id); ?>,<?php echo e($id); ?>)">
                         حذف
                         </span>
                 <?php if($status == 0){
     $studenttype = \App\Student_Type::where([['student_id','=',$student->id],['type_id','=',$id]])->first();
    }elseif($status == 1){
      $studenttype = \App\Student_Typecollege::where([['student_id','=',$student->id],['typecollege_id','=',$id]])->first();
    }elseif($status == 2){
         $studenttype = \App\Student_Course::where([['student_id','=',$student->id],['course_id','=',$id]])->first();
    }
?>
	
                    <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px" id="btning<?php echo e($student->id); ?>" onclick="activestudentcourse(<?php echo e($student->id); ?>,<?php echo e($id); ?>)">
                             <?php if($studenttype->active == 1): ?>
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
    "order": [[ 0, "desc" ]],
			"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
            },
        ]// Order on init. # is the column, starting at 0

});
	});function deletestudentcourse(id1,id2){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../deletestudentcourse`,
         //contentType: "application/json; charset=utf-8",
      data:{
        'course_id':id2,
        'student_id':id1,
        'status' :$("#status").val()
      },
       dataType: "Json",
       success: function(result){
    if(result.status == true){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم  حذف الطالب من الكورس ',
  showConfirmButton: false,
  timer: 1500
});
$(`#s${id1}`).remove();

    }
       }

      });
  };function activestudentcourse(id1,id2){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../activestudentcourse`,
        data:{
        'course_id':id2,
        'student_id':id1,
        'status' :$("#status").val()
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
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/courses_students/studentstype.blade.php ENDPATH**/ ?>