
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
                            <h5>المدرسين</h5>
                        </div>
                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <button class="btn w-100 mx-auto" >
                                      <a href="<?php echo e(route('addteacher')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة مدرس  
                                        </a>
                                    </button>
                                <div class="col-4">

                                </div>
                          </div>

                            </div>

                        </div>

                        <div class="pt-5">
                            <div class="row">
                                  <div class="table-responsive"?>
                                                      
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">الاسم</th>
					<th scope="col" class="text-center">qrcode teacher</th>
                     <th scope="col" class="text-center">الصوره</th>
                     <th scope="col" class="text-center">الماده</th>
                    <th scope="col" class="text-center">المكان</th>
                    <th scope="col" class="text_center">السنه</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="c<?php echo e($teacher->id); ?>">
						<td><?php echo e($teacher->id); ?></td>
                      
                          <?php $useryear = \App\User_Year::where('user_id',$teacher->id)->pluck('year_id')->toArray();
                      $years = \App\Year::whereIn('id',$useryear)->get();
                      $usersubject = \App\User_Subject::where('user_id',$teacher->id)->pluck('subject_id')->toArray();
                      $subjects = \App\Subject::whereIn('id',$usersubject)->get();
                      ?>
              <td scope="col" class='text-center'><a href="<?php echo e(route('teacherprofile',$teacher->id)); ?>"><?php echo e($teacher->name); ?></a></td>
						<td><?php if($teacher->code): ?>
							<?php echo QrCode::size(80)->backgroundColor(255,255,204)->generate($teacher->code); ?>

						<?php else: ?> 
					
							لايوجد كود للمدرس
					<?php endif; ?>	</td>
             <td scope="row" class='text-center'>
                 <img src="<?php echo e(url('uploads/'. $teacher->image)); ?>" style="width:120px;height:120px">
             </td>
             <td scope="col" class="text-center"> <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php echo e($subject->name_ar); ?>

                      <br/>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
             <td scope="col" class="text-center">
            
                   <?php echo e($teacher->address); ?>

                  </td>
                  <td>
                    
                      <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php echo e($year->year_ar); ?>

                      <br/>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>       <td class="text-center">
                               <span class="btn  btn-sm" style="border:1px solid #222; margin-bottom:10px;" id="btn<?php echo e($teacher->id); ?>" onclick="activeuser(<?php echo e($teacher->id); ?>)">
                             <?php if($teacher->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                                
                         </span>
						<!-- <a href="<?php echo e(route('editteacher',$teacher->id)); ?>">
                                            <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen"></a>-->
                                                            <a style=" margin-right: 20px;
" href="<?php echo e(route('editteacher',$teacher->id)); ?>">
                                            <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen"></a>
				   <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deleteuser('<?php echo e($teacher->id); ?>')" style="cursor:pointer;"> 
                        <a href="<?php echo e(route('teacherstudents',$teacher->id)); ?>" class="btn btn-success btn-sm" >الطلاب</a>
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
	})
function activeuser(id){
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
})
$(`#btn${id}`).html('تفعيل');

    }else if(result.status == 'active'){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم التفعيل  ',
  showConfirmButton: false,
  timer: 1500
})
$(`#btn${id}`).html('الغاء التفعيل');

    }
    
       }

      });
  }  function downloadimage(id){
    $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      $.ajax({
          url:`downloadqrcode/${id}`,
          type:'get',
          dataType:'json',
          success:function(result){
			 console.log(result)
         //   var link = document.createElement('a');
//link.href = result;
//link.download = result;
//document.body.appendChild(link);
//link.click();
//document.body.removeChild(link);  
          }
      })
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
    $(`#c${id}`).remove();
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
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/teachers.blade.php ENDPATH**/ ?>