 
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
                            <h5>الكورسات</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <button class="btn w-100 mx-auto" >
                                      <a href="<?php echo e(route('addcourse')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافه كورس  
                                        </a>
                                    </button>

                     



                                <div class="col-4">

                                </div>

                                



                                </div>

                            </div>

                        </div>


   <div class="row">
                     <div class="form-group col-lg-4 col-md-6 col-12">
                         <label>القسم فرعى</label>
                        <select name="sub_id" class="form-control" id="sub"  required onchange="getlecturer(this)">
                          <option value="0" selected="selected" disabled>
                              اختر قسم فرعى
                          </option>
                          <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($sub->id); ?>"><?php echo e($sub->name_ar); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                       <?php $__errorArgs = ['sub_id'];
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
                      </div>
                      <div class="row">
                            <div class="col-3 mx-auto">
                              
                        
                            <span class="btn btn-primary" onclick="filtercourses()">بحث</span>    </div>
                      </div>
                        <div class="pt-5">
                            <div class="row">
                                 <div class="table-responsive">                
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<td>id</td>
                     <th scope="col" class="text-center">الاسم</th>
                     <th scope="col" class="text-center">اسم المحاضر</th>
                    <th scope="col" class="text-center">القسم الرئيسى</th>
                    <th scope="col" class="text-center">القسم الفرعى</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody id="courses">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="g<?php echo e($course->id); ?>">
						<td class="text-center"><?php echo e($course->id); ?></td>
                <td scope="row" class="text-center">
                 <a href="<?php echo e(route('videosgeneral',$course->id)); ?>">  <?php echo e($course->name_ar); ?></a></td>
                    <td class="text-center"><?php echo e($course->user->name); ?></td>
                       <td class="text-center"><?php echo e($course->general->name_ar); ?></td>
                         <td class="text-center"><?php echo e($course->sub->name_ar); ?></td>
                        <td class="text-center">
                  <a href="<?php echo e(route('editcourse',$course->id)); ?>"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                          <?php if(auth()->user()->hasPermission("course-delete")): ?>
                           <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletecourse('<?php echo e($course->id); ?>')" style="cursor:pointer;"> 
                          <?php endif; ?>
                         <span class="btn text-white btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 20px" id="btn<?php echo e($course->id); ?>" onclick="activecourse(<?php echo e($course->id); ?>)">
                             <?php if($course->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                          </span>
                          <a     style="border:1px solid #222; margin-bottom:10px; padding:6px 20px"
 href="<?php echo e(route('groupcourses',$course->id)); ?>" class="btn  btn-sm">المجموعات</a>
                             <a     style="border:1px solid #222; margin-bottom:10px; padding:6px 20px"
 class="btn btn-sm mt-2" href="<?php echo e(route('courseexams',$course->id)); ?>">
                          الامتحانات
                         </a> <a class="btn btn-primary btn-sm mt-2" href="<?php echo e(route('studentscourse',$course->id)); ?>">
                          الطلاب
                         </a>
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
	"order":[[0,'desc']],
		columnDefs:[
			{
				  targets:0,
				visible:false
				  }]
	
	});
} );function activecourse(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activecourse/${id}`,
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
  }  function deletecourse(sel){
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
       url: `deletecourse/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $(`#g${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الكورس',
      'success'
         )
       }

      });
    }
   
   
  })
}function filtercourses(){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filtercourses`,
      //   contentType: "application/json; charset=utf-8",
       dataType: "Json",
      data:{
        "sub_id":$("#sub").val()
       
      },
       success: function(result){
    if(result.status == true){
$("#courses").empty();
      $("#courses").append(result.data);
    }
    
       }

      });
  }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/course.blade.php ENDPATH**/ ?>