
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
                            <h5>تعديل سؤال </h5>
                        </div>
                       <form method="post" action="<?php echo e(route('updatesubjectscollegequestions',$part->id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                  <div class="row mt-4">
                
 <div class="col-6">
   <label>القسم</label>
   <input type="text" class="form-control" name="part" value="<?php echo e($part->name); ?>">
                </div>                
                          </div>
                         <section id="section">
                           <?php $__currentLoopData = $part->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if($loop->first): ?>
                        <div class="info">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <input type="text" class="form-control" name="name[<?php echo e($key); ?>]" value="<?php echo e($question->name); ?>">
                            </div>
                                   <div class="col-12 text-center">
                                     <?php if($question->question_image): ?>
                                        <img src="<?php echo e(asset('uploads/'.$question->question_image)); ?>" id="realimg" style="width:100%;height:500px;">
                                     <?php else: ?>
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="realimg" style="width:100%;height:500px;">
                                     <?php endif; ?>
                    <br>
                   <input id="ad" type="file" class="form-control ehabtalaat"  name="question_image[<?php echo e($key); ?>]" style="width:50px;height:50px;">
                            <label for="ad" class="ahmed">اضافة صوره</label>
                            <?php $__errorArgs = ['question_image'];
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
                            
                          
                            <div class="col-2">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[<?php echo e($key); ?>]" value="<?php echo e($question->score); ?>">
                            </div>
                            <div class="col-3">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[<?php echo e($key); ?>]">
                            
                              <?php for($i = 1;$i < 10; $i++): ?>
                               <option value="<?php echo e($i); ?>" <?php if($question->question_level == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                 <?php endfor; ?>
                            </select>
                          </div>
                          </div>
                           <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div class="row">
                     
                            <div class="col-6">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control"  value="<?php echo e($answer->name); ?>"name="answer[<?php echo e($key); ?>][<?php echo e($key1); ?>]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[<?php echo e($key); ?>][<?php echo e($key1); ?>]"value="0">
                              <input type="checkbox" class="hello" name="correct[<?php echo e($key); ?>][<?php echo e($key1); ?>]" value="1" <?php if($answer->correct ==1 ): ?> checked <?php endif; ?>>
                            </div>
                          </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="row">
                            
                            <div class="col-3">
                              <label>الشرح</label>
                              <textarea rows="13" class="form-control" name="notes[<?php echo e($key); ?>]"><?php echo e($question->notes); ?></textarea>
                            </div>
                               <div class="col-3 text-center mb-5 set-img">
                                   <?php if($question->video): ?>
                                     <video width="200" height="200" controls >
                    
              <source src="<?php echo e(asset('uploads/'.$question->video)); ?>" id="video_here">
            Your browser does not support HTML5 video.
          </video>
                      <?php else: ?>
                    <video width="200" height="200" controls >
                    
              <source src="mov_bbb.mp4" id="video_here">
            Your browser does not support HTML5 video.
          </video>
                                 <?php endif; ?>
          <br>
          <br>
                   <input id="kt" type="file" class="form-control ehabtalaat"  name="video[<?php echo e($key); ?>]">
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
                           <div class="col-3 text-center set-img">
                                <?php if($question->image): ?>
                             <img src="<?php echo e(asset('uploads/'.$question->image)); ?>" id="realimg2">
                             <?php else: ?>
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="realimg2">
                             <?php endif; ?>
                    <br>
                   <input id="ad2" type="file" class="form-control ehabtalaat"  name="image[<?php echo e($key); ?>]">
                            <label for="ad2" class="ahmed">اضافة صوره</label>
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
                              <div class="col-3">
                             
                           <img src="<?php echo e(asset('plus.png')); ?>" style="width:40px;height:40px;cursor:pointer;margin-top:113px;" id="click" onclick="addquestion()">
                            </div>
                          </div>
                          <?php else: ?>
                    <div class="info" id="s<?php echo e($question->id); ?>">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <input type="text" class="form-control" name="name[<?php echo e($key); ?>]" value="<?php echo e($question->name); ?>">
                            </div>
                                   <div class="col-4 text-center">
                                     <?php if($question->question_image): ?>
                                        <img src="<?php echo e(asset('uploads/'.$question->question_image)); ?>" id="r<?php echo e($question->id); ?>"style="width:100px;height:100px;">
                                     <?php else: ?>
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>"  id="r<?php echo e($question->id); ?>" style="width:100px;height:100px;">
                                     <?php endif; ?>
                    <br>
                   <input id="d<?php echo e($question->id); ?>" type="file" class="form-control ehabtalaat"  onchange="getimage(<?php echo e($question->id); ?>)" name="question_image[<?php echo e($key); ?>]" style="width:50px;height:50px;">
                            <label for="d<?php echo e($question->id); ?>" class="ahmed">اضافة صوره</label>
                            <?php $__errorArgs = ['question_image'];
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
                            
                          
                            <div class="col-2">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[<?php echo e($key); ?>]" value="<?php echo e($question->score); ?>">
                            </div>
                            <div class="col-3">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[<?php echo e($key); ?>]">
                            
                              <?php for($i = 1;$i < 10; $i++): ?>
                               <option value="<?php echo e($i); ?>" <?php if($question->question_level == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                 <?php endfor; ?>
                            </select>
                          </div>
                          </div>
                           <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           
                   <div class="row">
                     
                            <div class="col-6">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[<?php echo e($key); ?>][<?php echo e($key1); ?>]" value="<?php echo e($answer->name); ?>" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[<?php echo e($key); ?>][<?php echo e($key1); ?>]"value="0">
                              <input type="checkbox" class="hello" name="correct[<?php echo e($key); ?>][<?php echo e($key1); ?>]" value="1" <?php if($answer->correct ==1 ): ?> checked <?php endif; ?>>
                            </div>
                          </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="row">
                            
                            <div class="col-3">
                              <label>الشرح</label>
                              <textarea rows="13" class="form-control" name="notes[<?php echo e($key); ?>]"><?php echo e($question->notes); ?></textarea>
                            </div>
                               <div class="col-3 text-center mb-5 set-img">
                                   <?php if($question->video): ?>
                                     <video width="200" height="200" controls >
                    
              <source src="<?php echo e(asset('uploads/'.$question->video)); ?>" id="video_here<?php echo e($key); ?>">
            Your browser does not support HTML5 video.
          </video>
                      <?php else: ?>
                    <video width="200" height="200" controls >
                    
              <source src="mov_bbb.mp4" id="video_here<?php echo e($question->id); ?>">
            Your browser does not support HTML5 video.
          </video>
                                 <?php endif; ?>
          <br>
          <br>
                   <input id="kt<?php echo e($question->id); ?>" type="file" class="form-control ehabtalaat"  onchange="getvideo(<?php echo e($question->id); ?>)"  name="video[<?php echo e($key); ?>]">
                            <label for="kt<?php echo e($question->id); ?>" class="ahmed">اضافة فيديو</label>
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
                           <div class="col-3 text-center set-img">
                                <?php if($question->image): ?>
                             <img src="<?php echo e(asset('uploads/'.$question->image)); ?>" id="b<?php echo e($question->id); ?>">
                             <?php else: ?>
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="b<?php echo e($question->id); ?>">
                             <?php endif; ?>
                    <br>
                   <input id="real<?php echo e($question->id); ?>" type="file" class="form-control ehabtalaat" onchange="getboard(<?php echo e($question->id); ?>)"  name="image[<?php echo e($key); ?>]">
                            <label for="real<?php echo e($question->id); ?>" class="ahmed">اضافة صوره</label>
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
                              <div class="col-3">
                             
                                                  <img src="<?php echo e(asset('remove.png')); ?>" style="width:40px;height:40px;cursor:pointer;margin-top:113px;" 
                                                       onclick="removequestion(<?php echo e($question->id); ?>)">
                            </div>
                          </div>
                           
                        <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </section>
                          	    <br><br>
                         <div class="progress px-3">
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
                                  <input type="submit"  value="حفظ"  style="cursor:pointer;" class="text-center">
                                </div>
                            </div>
                        </div>
                  </form>
                    </div>
                </div>
            </div>
             <!--</form>-->
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
   $("body").on('click','input:checkbox', function() {
    console.log("sasa");
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[class='" + $box.attr("class") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
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
});
  function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad2").change(function(){
    readURL2(this);
});

  $(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});   $('form').ajaxForm({
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
          location.href =`../subjectscollegequestions/${data.id}`;
        }
      }
    });function getvideo(c){
		  var output = document.getElementById(`kt${c}`);
		var $source = $(`#video_here${c}`);
  $source[0].src = URL.createObjectURL(output.files[0]);
  $source.parent()[0].load();
	}
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
}let id = 1;
  $("#click").click(function(){
    $("#section").append(` 
      <div class="info" id="s${id}">

                          <div class="row">
                            <div class="col-12">
                              <label>السؤال</label>
                              <input type="text" class="form-control" name="name[${id}]">
                            </div>
                                   <div class="col-12 text-center">
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="r${id}" style="width:100%;height:500px;">
                    <br>
                   <input id="d${id}" type="file" class="form-control ehabtalaat" onchange="getimage(${id})" name="question_image[${id}]">
                            <label for="d${id}" class="ahmed">اضافة صوره</label>
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
                          
                          <div class="row">
                            
                          
                            <div class="col-2">
                               <label>الدرجه</label>
                              <input type="number" class="form-control" name="score[${id}]">
                            </div>
                            <div class="col-3">
                                <label>المستوي</label>
                            <select class="form-control" name="question_level[${id}]">
                            
                              <?php for($i = 1;$i < 10; $i++): ?>
                               <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                 <?php endfor; ?>
                            </select>
                          </div>
                          </div>
                   <div class="row">
                            <div class="col-6">
                              <label>الاجابه 1</label>
                              <input type="text" class="form-control" name="answer[${id}][0]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][0]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][0]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 2</label>
                              <input type="text" class="form-control" name="answer[${id}][1]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][1]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][1]"  value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label> الاجابه 3</label>
                              <input type="text" class="form-control"name="answer[${id}][2]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][2]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][2]" value="1">
                            </div>
                          </div><div class="row">
                            <div class="col-6">
                              <label>  الاجابه 4</label>
                              <input type="text" class="form-control" name="answer[${id}][3]" required>
                            </div>
                            <div class="col-1">
                               <label></label>
                               <input type="hidden" class="form-control" name="correct[${id}][3]" value="0">
                              <input type="checkbox" class="hello${id}" name="correct[${id}][3]" value="1">
                            </div>
                          </div>
                          <div class="row">
                            
                            <div class="col-3">
                              <label>الشرح</label>
                              <textarea rows="13" class="form-control" name="notes[${id}]"></textarea>
                            </div>
                               <div class="col-3 text-center mb-5 set-img">
                    <video width="200" height="200" controls >
              <source src="mov_bbb.mp4" id="video_here${id}">
            Your browser does not support HTML5 video.
          </video>
          <br>
          <br>
                   <input id="kt${id}" type="file" class="form-control ehabtalaat" onchange="getvideo(${id})"  name="video[${id}]">
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
                           <div class="col-3 text-center set-img">
                               <img src="<?php echo e(asset('images/set-img.svg')); ?>" id="b${id}">
                    <br>
                   <input id="real${id}" type="file" class="form-control ehabtalaat" onchange="getboard(${id})" name="image[${id}]">
                            <label for="real${id}" class="ahmed">اضافة صوره</label>
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
                              <div class="col-3">
                             
                        <img src="<?php echo e(asset('remove.png')); ?>" style="width:40px;height:40px;cursor:pointer;margin-top:113px;" id="click" onclick="removequestion(${id})">
                            </div>
                          </div>
                           
                          	   `);
                            id++;
});
   function removequestion(id){
    $(`#s${id}`).remove();
    id--;
}
</script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/subjectscollegequestions/edit.blade.php ENDPATH**/ ?>