
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
                            <h5>الدكاتره</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-3">
                                    <button class="btn" >
                                      <a href="<?php echo e(route('adddoctor')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة دكتور  
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
					<th>id</th>
                     <th scope="col" class="text-center">الاسم</th>
						<th scope="col" class="text-center">qrcode doctor</th>
                     <th scope="col" class="text-center">الصوره</th>
                     <th scope="col" class="text-center">الكليه</th>
                     <th scope="col" class="text-center">الفرقه</th>
                     <th scope="col" class="text-center">القسم</th>
                     <th scope="col" class="text-center">الماده</th>
                   
                  
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="c<?php echo e($doctor->id); ?>">
                      
						<th ><?php echo e($doctor->id); ?></th>
              <td scope="col" class='text-center'>
				 <a href="<?php echo e(route('doctorprofile',$doctor->id)); ?>"> <?php echo e($doctor['name']); ?>

				  </a></td>
						<td scope="col" class="text-center">
						<?php if($doctor->code): ?>
							<?php echo QrCode::size(80)->backgroundColor(255,255,204)->generate($doctor->code); ?>

						<?php else: ?> 
					
							لايوجد كود  للدكتور
					<?php endif; ?></td>
             <td scope="row" class='text-center'>
                 <img src="<?php echo e(url('uploads/'. $doctor->image)); ?>" style="width:120px;height:120px">
             </td>
             <td scope="col" class="text-center">
				 <?php if($doctor->college): ?><?php echo e($doctor->college['name_ar']); ?>

				 <?php endif; ?></td>
             
             
           
                  
                      <?php
                 $dd =   \App\Doctor_Division::where('doctor_id',$doctor->id)->pluck('division_id')->toArray();
                 $divisions = \App\Division::whereIn('id',$dd)->get();
                 $ds =   \App\Doctor_Section::where('doctor_id',$doctor->id)->pluck('section_id')->toArray();
                 $sections = \App\Section::whereIn('id',$ds)->get();
                 $dg =    \App\Doctor_Subcollege::where('doctor_id',$doctor->id)->pluck('subcollege_id')->toArray();
                 $subcolleges = \App\SubjectsCollege::whereIn('id',$dg)->get();
                      ?>
                   <td scope="col" class="text-center">
                  <?php if($doctor->divisions): ?>
                <p> <?php echo e(implode('-',$doctor->divisions->pluck('name_ar')->toArray())); ?></p>
				<?php endif; ?>
                  </td>
                   <td scope="col" class="text-center">
                     	<?php if($doctor->sections): ?>
                <p> <?php echo e(implode('-',$doctor->sections->pluck('name_ar')->toArray())); ?></p>
				<?php endif; ?>
                  </td>
                   <td scope="col" class="text-center">
                     <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php echo e($d['name_ar']); ?> <br/>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  <td class="text-center">
                               <span class="btn  btn-sm" style="border:1px solid #222; margin-bottom:10px; padding:6px 20px;" id="btn<?php echo e($doctor->id); ?>" onclick="activeuser(<?php echo e($doctor->id); ?>)">
                             <?php if($doctor->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                         </span>	
                    	   <img style="margin-right:20px;" src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deleteuser('<?php echo e($doctor->id); ?>')" style="cursor:pointer;"> 
                        <a href="<?php echo e(route('editdoctor',$doctor->id)); ?>">
                                            <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen"></a>
                     <a href="<?php echo e(route('teacherstudents',$doctor->id)); ?>" class="btn btn-success btn-sm" >الطلاب</a>
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
  } function deleteuser(sel){
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
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/doctors.blade.php ENDPATH**/ ?>