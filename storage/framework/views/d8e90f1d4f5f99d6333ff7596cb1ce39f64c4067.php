
<?php $__env->startSection('style'); ?>
<style>
.selectpicker{
   width: 100% !important;
    display:block !important;
}
.selectpicker button{
     width: 100% !important;  
}
.setting .info button{
    width: 100% !important;
    background-color:white;
	border: 1px solid #75757542 !important;
}
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start;
	}
	.bootstrap-select>select{
		left: 0 !important;
	}
	.bootstrap-select.show-tick .dropdown-menu li a span.text{
		margin-right: 0 !important;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="<?php echo e(asset('images/setting.svg')); ?>">
                            <h5>تعديل دكتور </h5>
                        </div>
                         <!--   <form method="post" action="<?php echo e(route('storedoctor')); ?>" enctype="multipart/form-data">-->
                        	<!--<?php echo csrf_field(); ?>-->
                         
                                    
                                <div class="row">
                             <div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="<?php echo e(asset('uploads/'.$doctor->image)); ?>" id="realimg">
                    <br>
                               <input id="ad" type="file" class="form-control ehabtalaat"  name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                 <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                 <p style="color:red;"><?php echo e($message); ?></p>
                                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div><div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="<?php echo e(asset('uploads/'.$doctor->cover_image)); ?>" id="realimg3">
                    <br>
                               <input id="ad3" type="file" class="form-control ehabtalaat" required name="cover_image">
                                        <label for="ad3" class="ahmed">اضافة cover </label>
                                 <?php $__errorArgs = ['cover_image'];
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
									<div class="col-lg-3 col-md-6 col-12 text-center set-img">
                               <img src="<?php echo e(asset('uploads/'.$doctor->printsplash)); ?>" id="realimg2">
                    <br>
                               <input id="ad2" type="file" class="form-control ehabtalaat"  name="printsplash">
                                        <label for="ad2" class="ahmed">اضافة print splash</label>
                                 <?php $__errorArgs = ['printsplash'];
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
   <div class="col-lg-3 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="<?php echo e(asset('uploads/'.$doctor->intro)); ?>" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt" type="file" class="form-control ehabtalaat" name="url">
                            <label for="kt" class="ahmed">اضافة فيديو</label>
                            <?php $__errorArgs = ['url'];
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
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>الاسم</label>
                                    <input class="form-control" type="text" value="<?php echo e($doctor->name); ?>" id="name" name="name" required>
                                     <?php $__errorArgs = ['name'];
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
                                    <label>الايميل</label>
                                    <input class="form-control" type="text" name="email"  id="email" value="<?php echo e($doctor->email); ?>" required>
                                     <?php $__errorArgs = ['email'];
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
                                    <label>كلمه السر</label>
                                    <input class="form-control" type="password" id="password" name="password"  >
                                     <?php $__errorArgs = ['password'];
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
                                    <label>الهاتف</label>
                                    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo e($doctor->phone); ?>">
                                     <?php $__errorArgs = ['phone'];
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
                                    <div class="form-group col-lg-3 col-md-6 col-12">
                                        <label>المحافظة</label>
                      <select name="state_id" class="form-control" id="state" onchange="getcity(this)" required>
                          <option value="state_id" selected="selected" disabled>اختر محافظه</option>
                          <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($state->id); ?>" <?php if($doctor->state_id == $state->id): ?> selected <?php endif; ?>><?php echo e($state->state); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                           <?php $__errorArgs = ['state_id'];
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
                                 <label>المدينة</label>
                      <select name="city_id" class="form-control" id="city" required>
                          <option value="city_id" selected="selected" disabled >اختر مدينه</option>
                          <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($city->id); ?>" <?php if($doctor->city_id == $city->id): ?> selected <?php endif; ?>><?php echo e($city->city); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                           <?php $__errorArgs = ['city_id'];
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
                               <label>العنوان</label>
                               <input type="text" name="address"  value="<?php echo e($doctor->name); ?>"  class="form-control" required>
                           <?php $__errorArgs = ['address'];
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
                                     
                              <label for="pay">الجامعات </label><br >
                               <select class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;"
                               onchange="getcollege(this)" name="university_id" id="university" data-live-search="true">
                                 <option value="0">اختر جامعه</option>
                                       <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($university->id); ?>" <?php if($doctor->university_id == $university->id): ?> selected <?php endif; ?>><?php echo e($university->name_ar); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
                                   </select>
                                   <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                               </div>
                            </div>
                     <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12">
                                    <label for="p">اسم الكليه </label>
                                   <select id="college"  class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" name="college" data-live-search="true"
                               onchange="getdivision(this)" required>
                                       <option value="0" disabled="disabled" selected="selected">اختر كليه</option>
                                       <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($college->id); ?>" <?php if($doctor->college_id == $college->id): ?> selected <?php endif; ?>><?php echo e($college->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                    <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select  multiple class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" data-live-search="true" id="division" name="division_id[]" onchange="getsection2()" required>
                                       <option value="0" disabled="disabled" >اختر قسم</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>" <?php if($doctor->divisions->pluck('id')->contains($division->id)): ?> selected <?php endif; ?> ><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                   
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id[]" multiple class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" data-live-search="true" id="section" onchange="getsubcollege()" required>
                                      
                                       <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($section->id); ?>"  <?php if($doctor->sections->pluck('id')->contains($section->id)): ?> selected <?php endif; ?> ><?php echo e($section->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id[]" multiple class="form-control qeno-select selectpicker"
                               style="display:block;width:100% !important;" data-live-search="true" id="subcollege" required>
                                   
                                       <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($subcollege->id); ?>" <?php if($doctor->subcolleges->pluck('id')->contains($subcollege->id)): ?> selected <?php endif; ?>><?php echo e($subcollege->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                               
                        </div>
                          <input type="hidden" value="<?php echo e($doctor->id); ?>" id="id">
                        
                           <div class="row">
                               <div class="form-group col-lg-6 col-md-6 col-12">
                                   <label>الوصف</label>
                                   <textarea class="form-control" rows="5" id="description" name="description"><?php echo e($doctor->description); ?></textarea>
                               </div>
                           </div>

                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="button" onclick="storedoctor()" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                    <!--</form>-->
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
<script>
    function getyear(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `../getyear/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#subject').empty();
        $('#subject').html(result);
        
       }

      });
}
  function getteacher(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `../getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result);
        
       }

      });
}

function getcity(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getcity/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#city').empty();
       $('#city').html(result);
       console.log(result);
       }

      });
    }


    function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
     $('#division').selectpicker('refresh');
       }

      });
  }
  function getsection2(){
     var selected = [];
        //  var division = [];
            // $.each($("#division"), function () {
            //     division.push( $(this).val());
            // });
            
               let  division = $("#division").val();
               console.log(division);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      
       url: `../getsection2`,
       type: "post",
              data:{
                  "division":division
              },
        // contentType: "application/json; charset=utf-8",
    //   dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
     $('#section').selectpicker('refresh');
       }

      });
  }
  function getsubcollege(){
         
            let subcollege = $("#section").val();
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `../getsubcollege2`,
       //  contentType: "application/json; charset=utf-8",
     
       data:{
         "subcollege":subcollege
       },
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       $('#subcollege').selectpicker('refresh');
       }

      });
  }
   function getcollege(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
  //     dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       $('#college').selectpicker('refresh');
       console.log(result);
       }

      });
    }
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
 function storedoctor(){
	 
let id = $("#id").val();
  var arr = $('#subcollege').val();
	  var arr2 = $('#division').val();
	   var arr3 = $('#section').val();
	 let formdata = new FormData();

	 formdata.append('subjectscollege_id',JSON.stringify(arr));
	 formdata.append("name", $('#name').val());
	 formdata.append("email", $('#email').val());
	 formdata.append("phone", $('#phone').val());
	  formdata.append("address", $('#address').val());
	 formdata.append("password", $('#password').val());
	 formdata.append("college_id", $('#college').val());
	 formdata.append("university_id", $('#university').val());
	formdata.append("state_id", $('#state option:selected').val());
	 formdata.append("city_id", $('#city option:selected').val());
	 formdata.append('division_id',JSON.stringify(arr2))
	 formdata.append('section_id',JSON.stringify(arr3))
    if($('#ad')[0].files[0] != undefined){
	formdata.append('image',$('#ad')[0].files[0]);
	}if($('#ad2')[0].files[0] != "undefined"){
	formdata.append('printsplash',$('#ad2')[0].files[0]);
	}if($('#kt')[0].files[0] != "undefined"){
	formdata.append('intro',$('#kt')[0].files[0]);
	}if($('#ad3')[0].files[0] != "undefined"){
	formdata.append('cover_image',$('#ad3')[0].files[0]);
	}
		
		 
    $.ajax({
       type:"post",
       url: `../updatedoctor/${id}`,
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		enctype:'multipart/form-data',
    	   contentType: false,
               processData: false,
	//	contentType: false,
   //contentType: "application/json; charset=utf-8",
      dataType: "json",
       data:formdata,
       success: function(result){
      if(result.status == true){
          Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم تعديل الدكتور',
  showConfirmButton: false,
  timer: 1500
})
location.reload();
      }else if(result.status == false){
             Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: result.message,

})
      }
       }

      });
    }
$("#ad").change(function(){
    readURL(this);
}); $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad2").change(function(){
    readURL2(this);
});   function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}$("#ad3").change(function(){
    readURL3(this);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Coursat\resources\views/dashboard/editdoctor.blade.php ENDPATH**/ ?>