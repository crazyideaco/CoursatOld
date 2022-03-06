
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
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="<?php echo e(asset('images/setting.svg')); ?>">
                            <h5>اضافه كورس</h5> 
                        </div>
                            <form method="post" action="<?php echo e(route('storetypescollege')); ?>" 
                            enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
    
                        <div class="info">
                                <div class="row">
                                         <div class="col-6 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                               <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
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
                                        <div class="col-6 text-center set-img">
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
                                       </div>
                                  <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                            <div class="row">
                                 <div class="form-group col-3">
                                    <label> اسم   الكورس بالعربى  </label>
                                    <input class="form-control" required type="text" name="name_ar">
                                    <?php $__errorArgs = ['name_ar'];
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
                                <div class="form-group col-3">
                                    <label>اسم الكورس بالانجليزي</label>
                                    <input class="form-control" required type="text" name="name_en">
                                     <?php $__errorArgs = ['name_en'];
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
                                    <div class="form-group col-3">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" onchange="getcolleges(this)">
                                       <option value="0" disabled="disabled">اختر جامعه</option>
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
                                 <div class="form-group col-3">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="0" disabled="disabled" >اختر كليه</option>
                                       <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($college->id); ?>"><?php echo e($college->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 <div class="form-group col-3">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="0" disabled="disabled" >اختر قسم</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>"><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getsubcollege(this)" >
                                       <option value="0" disabled="disabled" >اختر فرقه</option>
                                       <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($section->id); ?>"><?php echo e($section->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" onchange="getdoctor(this)" >
                                       <option value="0" disabled="disabled">اختر ماده</option>
                                       <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($subcollege->id); ?>"><?php echo e($subcollege->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 
                                 <div class="form-group col-3">
                                 <label>اختر الدكتور</label>
                      <select name="doctor_id" class="form-control" required  id="doctor">
                          <option value="0"  disabled>اختر الدكتور</option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                           </div>
                             <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker" data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                                 <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="    height: 36px;" type="number" name="points">
                               </div>
                               
                            </div>
                            <?php elseif(Auth::user() &&Auth::user()->is_student == 5 && Auth::user()->category_id == 2): ?>
                            <div class="row">
                                 <div class="form-group col-3">
                                    <label> اسم  الكورس بالعربى  </label>
                                    <input class="form-control" required type="text" name="name_ar">
                                     <?php $__errorArgs = ['name_ar'];
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
                                <div class="form-group col-3">
                                    <label>اسم الكورس بالانجليزي</label>
                                    <input class="form-control" required type="text" name="name_en">
                                     <?php $__errorArgs = ['name_en'];
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
                                    <div class="form-group col-3">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" onchange="getcolleges(this)">
                                       <option value="0" disabled="disabled" >اختر جامعه</option>
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
                                 <div class="form-group col-3">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control"  id="college" onchange="getdivision(this)">
                                       <option value="0" disabled="disabled">اختر كليه</option>
                                       <?php $__currentLoopData = $colleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $college): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($college->id); ?>"><?php echo e($college->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 <div class="form-group col-3">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="0" disabled="disabled" >اختر فرقه</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>"><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getsubcollege(this)" >
                                       <option value="0" disabled="disabled" >اختر قسم</option>
                                       <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($section->id); ?>"><?php echo e($section->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege"  onchange="getdoctor(this)" >
                                       <option value="0" disabled="disabled" >اختر ماده</option>
                                       <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($subcollege->id); ?>"><?php echo e($subcollege->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 
                                 <div class="form-group col-3">
                                 <label>اختار الدكتور</label>
                      <select name="doctor_id" class="form-control"  required id="doctor">
                          <option value="0"  disabled>اختر الدكتور</option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                           </div>
                             <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker" data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                                 <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="height: 36px;" required type="number" name="points">
                               </div>
                               
                            </div>
                            <?php elseif(Auth::user() &&Auth::user()->is_student == 3): ?>
                              <div class="row">
                                 <div class="form-group col-3">
                                    <label> اسم  الكورس بالعربى  </label>
                                    <input class="form-control" required type="text" name="name_ar">
                                     <?php $__errorArgs = ['name_ar'];
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
                                <div class="form-group col-3">
                                    <label>اسم الكورس بالانجليزي</label>
                                    <input class="form-control" required type="text" name="name_en">
                                     <?php $__errorArgs = ['name_en'];
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
                            
                                 <div class="form-group col-3">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getdocsection(this)">
                                       <option value="0" disabled="disabled" >اختر قسم</option>
                                       <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($division->id); ?>"><?php echo e($division->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getdocsubcollege(this)" >
                                       <option value="0" disabled="disabled" >اختر فرقه</option>
                                       <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($section->id); ?>"><?php echo e($section->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" >
                                       <option value="0" disabled="disabled" >اختر ماده</option>
                                       <?php $__currentLoopData = $subcolleges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcollege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($subcollege->id); ?>"><?php echo e($subcollege->name_ar); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                                 
                            
                             <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker" data-live-search="true"  multiple name="tag_id[]">
                                      
                                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                                 <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input style="    height: 36px;" type="number" name="points">
                               </div>
                               
                            </div>
                           <?php endif; ?>
                           <div class="form-group col-6">
                                   <label>الوصف </label>
                                   <textarea class="form-control" rows="5" name="description"></textarea>
                               </div>
                               </div>
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                    </form>
                        <br />
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
    function readURL(input) {
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
});$(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
}); $('form').ajaxForm({
      beforeSend:function(){
        $('#success').empty();
      },
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
         location.href ='typescolleges';
        }
      }
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcourses.net/public_html/resources/views/dashboard/addtypescollege.blade.php ENDPATH**/ ?>