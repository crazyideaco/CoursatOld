
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
	}.btning{
      background-color:green !important;
      width: fit-content !important;
      font-size:11px;
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
                            <h5>كورس
                            </h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                    <button class="btn" >
                                      <a href="<?php echo e(route('addtypescollege')); ?>">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافه كورس  
                                        </a>
                                    </button>

                            </div>

                        </div>
<div class="row">
     <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" id="university" onchange="getcolleges(this)">
                                       <option value="0" >اختر جامعه</option>
                                       <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($university->id); ?>">
                                           <?php echo e($university->name_ar); ?>

                                           </option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                    <?php $__errorArgs = ['university_id'];
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
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="0"  >اختر كليه</option>
                                       <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($college->id); ?>"><?php echo e($college->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="0"  >اختر قسم</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>"><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getsubcollege(this)" >
                                       <option value="0"  >اختر فرقه</option>
                                       <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($section->id); ?>"><?php echo e($section->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                      </div>
                      <div class="row">
                        
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" onchange="getdoctor(this)" >
                                       <option value="0" >اختر ماده</option>
                                       <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($subcollege->id); ?>"><?php echo e($subcollege->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                      </div>

      <div class="row">
                            <div class="col-3 mx-auto">
                              
                        
                            <span class="btn btn-primary" onclick="filtertypescollege()">بحث</span>    </div>
                          </div>
                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table table-responsive col-12" style="width:100%">
   <thead>
                <tr>
					<td>id</td>
                    <td scope="col" class="text-center"> اسم الكورس</td>
                    <td scope="col" class="text-center">اسم الماده</td>
                    <td scope="col" class="text-center">القسم</td>
                     <th scope="col" class="text-center">الفرقه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                    <th scope="col" class="text-center">اسم الجامعه </th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody id="typescolleges">
                    <?php $__currentLoopData = $typescolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typescollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <tr id="un<?php echo e($typescollege->id); ?>">
						<td><?php echo e($typescollege->id); ?></td>
                          <td scope="row" class="text-center">
                   <a href="<?php echo e(route('lessons',$typescollege)); ?>"> <?php echo e($typescollege->name_ar); ?></a></td>
                   
                   <td scope="row" class="text-center">
                   <?php echo e($typescollege->subjectscollege->name_ar); ?></td>
                   <td scope="row" class="text-center">
                   <?php echo e($typescollege->section->name_ar); ?></td>
                <td scope="row" class="text-center">
                   <?php echo e($typescollege->division->name_ar); ?></td>
                    <td class="text-center"><?php echo e($typescollege->college->name_ar); ?></td>
                          <td class="text-center"><?php echo e($typescollege->university->name_ar); ?></td>
                        <td class="text-center">
                  <a href="<?php echo e(route('edittypescollege',$typescollege->id)); ?>"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen" 
                         style="cursor: pointer"></a>
                           <span class="btn bg-success text-white btn-sm btning" id="now<?php echo e($typescollege->id); ?>" onclick="activetypecollege(<?php echo e($typescollege->id); ?>)">
							   							
                             <?php if($typescollege->active == 1): ?>
                             الغاء التفعيل
                             <?php else: ?>
                             تفعيل
                             <?php endif; ?>
                         </span>
                           <a  href="<?php echo e(route('groupstypescollege',$typescollege->id)); ?>" class="btn bg-success text-white btn-sm btning">المجموعات</a>
                              <?php if(auth()->user()->hasPermission("typescolleges-delete")): ?>
							 <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletetypescollege('<?php echo e($typescollege->id); ?>')" style="cursor:pointer;"> 
                          <?php endif; ?>
                              <a class="btn btn-primary btn-sm mt-2" href="<?php echo e(route('typescollegeexams',$typescollege->id)); ?>">
                          الامتحانات
                         </a>  <a class="btn btn-primary btn-sm mt-2" href="<?php echo e(route('studentstypecollege',$typescollege->id)); ?>">
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
function activetypecollege(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activetypecollege/${id}`,
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
$(`#now${id}`).html('تفعيل');

    }else if(result.status == 'active'){
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم التفعيل  ',
  showConfirmButton: false,
  timer: 1500
});
$(`#now${id}`).html('الغاء التفعيل');

    }
    
       }

      });
  } function deletetypescollege(sel){
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
       url: `deletetypescollege/${id}`,
   //    contentType: "application/json; charset=utf-8",
//       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#un${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الكورس بنجاح',
      'success'
         )
       }
           }
        
    });
    }
   
   
  })
}   function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
       }

      });
  }
  function getsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  }
  function getsubcollege(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  }
  function getdocsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdocsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  }
   function getdocsubcollege(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdocsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  } function getdoctor(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdoctor/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#doctore').empty();
    $('#doctor').html(result);
       }

      });
  }
  function getcolleges(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       console.log(result);
       }

      });
    }
  function filtertypescollege(){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filtertypescollege`,
      //   contentType: "application/json; charset=utf-8",
       dataType: "Json",
      data:{
        "university_id":$("#university").val(),
          "college_id":$("#college").val(),
          "division_id":$("#division").val(),
          "section_id":$("#section").val(),
          "subjectscollege_id":$("#subcollege").val(),
       
      },
       success: function(result){
    if(result.status == true){
       $('#example').DataTable().destroy();
      $("#typescolleges").empty();
      $("#typescolleges").append(result.data);
       $('#example').DataTable().draw();
    }
    
       }

      });
  }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/typescolleges.blade.php ENDPATH**/ ?>