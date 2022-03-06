<?php $__env->startSection('content'); ?>

<style>
  .setting .info button{
    width: 100%;
  }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
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
                            <h5>اضافه حصه </h5>
                        </div>
                        <form method="post" action="<?php echo e(route('storelesson',$id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                          
                                    <div class="info">
                                        <!--<input value="<?php echo e($id); ?>" id="id2" type="hidden">-->
                                        <div class="row">
                                                     <div class="col-lg-4 col-md-6 col-12 text-center mb-5 set-img">
                                <video width="200" height="200" controls >
                          <source src="mov_bbb.mp4" id="video_here">
                        Your browser does not support HTML5 video.
                      </video>
                      <br><br>
                               <input id="kt" type="file" onchange="getvid()" class="form-control in ehabtalaat" name="intro">
                                        <label for="kt" class="ahmed">اضافة انترو</label>
                                        <?php $__errorArgs = ['intro'];
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
                                   <div class="col-lg-4 col-md-6 col-12 text-center set-img">
                                        <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="realimg">
                                   <br>
                               <input id="ad" type="file" class="form-control ehabtalaat" name="image">
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
                           </div>
                                                <div class="col-lg-4 col-md-6 col-12 text-center set-img">
                                           <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="notes1">
                                <br>
                               <input id="notes" type="file" class="form-control ehabtalaat"  name="notes">
                                        <label for="notes" class="ahmed">اضافة notes</label>
                                        <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                         <p style="color:red;"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>   <div class="col-lg-4 col-md-6 col-12 text-center set-img">
                                                   <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="realimg1">
                                <br>
                               <input id="ad1" type="file" class="form-control ehabtalaat" accept="application/pdf" name="part_paper">
                                        <label for="ad1" class="ahmed">اضافة مذكره حصه</label>
                                        <?php $__errorArgs = ['part_paper'];
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
                               <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                            <div class="row">
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالعربى </label>
                                    <input class="form-control" type="text" name="name_ar" id="name_ar">
                                </div>
                                 <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالانجليزي </label>
                                    <input class="form-control" type="text" name="name_en" id="name_en">
                                </div>
                    
                            
                                     <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">
                                      
                                       </div>
                                  <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">
                                      
                                       </div>
                                 <div class="col-lg-4 col-md-6 col-12">
                                 <label>التاج </label>
                                <select class="form-control selectpicker " title="التاج" data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                                <div class="form-group col-lg-4 col-md-6 col-12">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;" min="0" type="number" name="order_number">
                               </div>
                            </div> 
                            <?php elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2): ?>
                              <div class="row">
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالعربى </label>
                                    <input class="form-control" type="text" name="name_ar"  id="name_ar">
                                </div>
                                 <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالانجليزي </label>
                                    <input class="form-control" type="text" name="name_en" id="name_en">
                                </div>
                               
                                      <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">
                                      
                                       </div>
                                  <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">
                                      
                                       </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                 <label>التاج </label>
                                <select class="form-control selectpicker " data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                                <div class="form-group col-lg-4 col-md-6 col-12">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;"   min="0"  type="number" name="order_number">
                               </div>
                               
                            </div> 
                          <?php elseif(Auth::user() && Auth::user()->is_student == 3): ?>
                              <div class="row">
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالعربى </label>
                                    <input class="form-control" type="text" name="name_ar" id="name_ar">
                                </div>
                                 <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> اسم الحصه بالانجليزي </label>
                                    <input class="form-control" type="text" name="name_en" id="name_en" >
                                </div>
                                   <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط الحصه</label>

                               <input id="points" type="number" class="form-control" name="points"
                               placeholder="النقاط">
                                      
                                       </div>
                                  <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label> نقاط المذكره</label>

                               <input id="part_points" type="number" class="form-control" name="part_points"
                               placeholder="النقاط">
                                      
                                       </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                 <label>التاج </label>
                                <select class="form-control selectpicker " data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                               <div class="form-group col-lg-4 col-md-6 col-12">
                               <label>ترتيب الحصص </label>
                               <input style="height: 36px;"  min="0"   type="number" name="order_number">
                               </div>
                            
                             
                               
                            </div>
                          <?php endif; ?>
                       <div class="form-group col-lg-4 col-md-6 col-12">
                                   <label>الوصف </label>
                                   <textarea class="form-control" rows="5" name="description"></textarea>
                      </div></div>
                            <section id="s0" >      
                       <!--     <div class="row">
                               <div class="col-lg-4 col-md-6 col-12 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here0">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt0"  type="file" onchange="getvideo(0)"  class="form-control url ehabtalaat" name="url[]">
                            <label for="kt0" class="ahmed">اضافة فيديو</label>
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
                           </div><div class="col-lg-4 col-md-6 col-12 text-center set-img">
                            <canvas class="pdfViewer" style="width:200px;height:200px"></canvas>
                   <input id="myPdf0" type="file" class="form-control pdf ehabtalaat" name="pdf[]">
                   <br>
<br>
                            <label for="myPdf0" class="ahmed">اضافة pdf</label>
                            <?php $__errorArgs = ['pdf'];
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
                           <div class="col-lg-4 col-md-6 col-12 text-center set-img">
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="r0" class="realimg">
                    <br>
                   <input id="d0" type="file" class="form-control image ehabtalaat" onchange="getimage(0)" name="images[]">
                            <label for="d0" class="ahmed">اضافة صوره</label>
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
               </div>
                                    
                            <div class="col-lg-4 col-md-6 col-12 text-center set-img">
                                <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="b0" class="realboard">
                                <br>
                               <input id="real0" type="file" class="form-control board ehabtalaat" onchange="getboard(0)" name="boards[]">
                                        <label for="real0" class="ahmed">سبوره الحصه</label>
                                        <?php $__errorArgs = ['board'];
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
                            <div class="row mt-5">
                                     <div class="form-group col-lg-4 col-md-6 col-12">
                                  <input id="name_ar" type="text" style="width:100%" class="form-control name_ar" name="names_ar[]"
                               placeholder="عنوان الفيديو بالعربى ">
                               </div>  <div class="form-group col-lg-4 col-md-6 col-12">
                                  <input id="name_en" type="text" style="width:100%" class="form-control name_en" name="names_en[]"
                               placeholder="عنوان الفيديو بالانجليزي ">
                               </div>
                           <div class="form-group col-lg-4 col-md-6 col-12">
                             <label>مدفوع</label>
                             <label class="switch">
                              <input type="checkbox" name="pay[]" class="pay" value="1">
                              <span class="slider round"></span>
                            </label>
                              
                               <br>
                               
                           </div>
                             <div class="form-group col-lg-4 col-md-6 col-12">
                               <label class="d-block">ترتيب الفيديو </label>
                               <input style="height: 36px;width: 100%;"  min="0"  type="number" name="order[]">
                               </div>
                            </div>
                              <div class="row">
                               <div class="form-group col-lg-4 col-md-6 col-12">
                                   <label>الوصف بالعربى</label>
                                   <textarea class="description_ar form-control" name="description_ar[]" rows="6"></textarea>
                               </div>
                               <div class="form-group col-lg-4 col-md-6 col-12">
                                   <label>الوصف بالانجليزي</label>
                                   <textarea class="description_en form-control" name="description_en[]" rows="6"></textarea>
                               </div>
                              </div>--->
                          </section>
                               <br><br>
                         <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                     <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="button" id="clicked" value="اضافه المزيد" class="text-center">
                                </div>
                            </div>
                        </div>
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input   type="submit" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                  </form>
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
    function getdivision(selected){
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
   function gettypescollege(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `gettypescollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#typescollege').empty();
    $('#typescollege').html(result);
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
  }function getdoctypescollege(selected){
      let id = selected.value;
      console.log(id);
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdoctypescollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#typescollege').empty();
    $('#typescollege').html(result);
       }

      });
  } function getcolleges(selected){
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
    } function getdoctorscollege(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdoctorscollege/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#doctor').empty();
       $('#doctor').html(result.data);
       console.log(result);
       }

      });
    };function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad").change(function(){
    readURL(this);
});

function getimage(f){
    var output = document.getElementById(`d${f}`);
    if (output.files && output.files[0]) {
        var reader = new FileReader();
        console.log(output);
        reader.onload = function (e) {
            $(`#r${f}`).attr('src', e.target.result);
        }

        reader.readAsDataURL(output.files[0]);
    }
}
function getboard(f){
    var output = document.getElementById(`real${f}`);
    if (output.files && output.files[0]) {
        var reader = new FileReader();
        console.log(output);
        reader.onload = function (e) {
            $(`#b${f}`).attr('src', e.target.result);
        }

        reader.readAsDataURL(output.files[0]);
    }
}
let c = 1;
$("#clicked").click(function(){
    $('.info').append(`<section id="s${c}">      
        <div class="row">
                       <div class="col-6 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here${c}">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt${c}" type="file"  onchange="getvideo(${c})"   class="form-control url ehabtalaat" name="url[]">
                            <label for="kt${c}" class="ahmed">اضافة فيديو</label>
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
                           </div><div class="col-6 text-center set-img">
                            <canvas class="pdfViewer" style="width:200px;height:200px"></canvas>
                   <input id="myPdf${c}" type="file" class="form-control pdf ehabtalaat" name="pdf[]">
                   <br>
<br>
                            <label for="myPdf${c}" class="ahmed">اضافة pdf</label>
                            <?php $__errorArgs = ['pdf'];
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
                           <div class="col-6 text-center set-img">
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="r${c}" class="realimg">
                    <br>
                   <input id="d${c}" type="file" class="form-control image ehabtalaat" onchange="getimage(${c})"  name="images[]">
                            <label for="d${c}" class="ahmed">اضافة صوره</label>
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
               </div>
                                    
                            <div class="col-6 text-center set-img">
                                <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="b${c}"  class="realboard">
                                <br>
                               <input id="real${c}" type="file" onchange="getboard(${c})" class="form-control board ehabtalaat" name="boards[]">
                                        <label for="real${c}" class="ahmed">سبوره الحصه</label>
                                        <?php $__errorArgs = ['board'];
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
                            <div class="row mt-5">
                                     <div class="form-group col-4">
                                  <input id="name_ar" type="text" class="form-control name_ar" name="names_ar[]"
                               placeholder="عنوان الفيديو بالعربى ">
                               </div>  <div class="form-group col-4">
                                  <input id="name_en" type="text" class="form-control name_en" name="names_en[]"
                               placeholder="عنوان الفيديو بالانجليزي ">
                               </div>
                           <div class="form-group col-2">
                               <label for="pay" class="paylabel">مدفوع</label>
                               <input class="pay" type="checkbox"  value="1" name="pay[]">
                               <br>
                               
                           </div> 
   <div class="form-group col-3">
                               <label>ترتيب الفيديو </label>
                               <input style="height: 36px;"  min="0"  type="number" name="order[]">
                               </div>
                           </div>
                           <div class="row">
                                <div class="col-4">
                                   <label>الوصف بالعربى</label>
                                   <textarea class="description_ar form-control" name="description_ar[]"rows="6"></textarea>

                                   <label>الوصف بالانجليزي</label>
                                   <textarea class="description_en form-control" name="description_en[]" rows="6"></textarea>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                   <button class="form-control btn btn-danger btn-sm" onclick="removesection(${c})" 
                                    > حذف</button>
                                </div>
                           </div>
                           </div>
                         
                            
                          
                          </section>`);
                            c++;
});
function removesection(c){
    $(`#s${c}`).remove();
    c--;
}   $('form').ajaxForm({
  
      beforeSend:function(){
        
        $('#success').empty();
        
                <?php
$msg = null;
$type = \App\TypesCollege::where('id',$id)->first();
if(auth()->user() && auth()->user()->isAdmin == 'admin'){
      
    $paqauser= \App\Paqa_User::with("paqa")->where("user_id",$type->doctor_id)->first();
    if($paqauser==null){
     $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
    //   return response()->json(['status' => false,'errors' => $msg]);
}
   elseif($paqauser->expired_at ==\Carbon\Carbon::now()->format('Y-m-d')){
            $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);

  }
} elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
  $paqauser= \App\Paqa_User::with("paqa")->where("user_id",auth()->user()->id )->first();
  if($paqauser==null){
   $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
   //  return response()->json(['status' => false,'errors' => $msg]);
}
 elseif($paqauser->expired_at == \Carbon\Carbon::now()->format('Y-m-d')){
         $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);
}
}if(Auth::user() && Auth::user()->is_student == 2){
             
  $paqauser= \App\Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
  if($paqauser==null){
    $msg='انت غير مشترك في باقه برجاء الاشتراك في باقه';
    // return response()->json(['status' => false,'errors' => $msg]);
}
 elseif($paqauser->expired_at ==\Carbon\Carbon::now()->format('Y-m-d')){
           $msg = 'انتهت صلاحيه الباقه';
//return response()->json(['status' => false,'errors' => $msg]);
}}?>
         /* $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');*/
        var message= '<?php echo $msg;?>';
          $('#success').html('<span class="text-danger"><b>'+message+'</b></span><br /><br />');
      },
  <?php   if($msg){
     }else{ ?>
      uploadProgress:function(event, position, total, percentComplete)
      {
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
        if(data.errors)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
        }
        if(data.success)
        {
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
        location.href ='../lessons/' + data.id;
        }
      }
<?php  }?>
    });function getvideo(c){
		  var output = document.getElementById(`kt${c}`);
		var $source = $(`#video_here${c}`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}function getvid(){
		  var output = document.getElementById(`kt`);
		var $source = $(`#video_here`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg1').attr('src', "https://upload.wikimedia.org/wikipedia/commons/3/38/Icon_pdf_file.svg");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad1").change(function(){
    readURL1(this);
});
  function writerURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#notes1').attr('src', "e.target.result");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#notes").change(function(){
    writerURL1(this);
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcourses.net/public_html/resources/views/dashboard/addlesson.blade.php ENDPATH**/ ?>