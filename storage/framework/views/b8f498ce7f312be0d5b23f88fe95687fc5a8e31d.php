
<?php $__env->startSection('content'); ?>
<style>
	.setting .info button{
		width: 100% !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start !important;
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
                            <h5>ارسال الاشعارات  </h5>
                        </div>
   
                          
                     
                        <div class="info">
                            <div class="row">
                              
                          
                                <div class="form-group col-12">
                                    <label>العنوان  </label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " id="title" name="title">
                         
                           </div>
                            <div class="form-group col-12">
                                    <label>  النص</label>
                    <input type="text" class="form-control" 
                            id="text" name="name_en">
       
                           </div>
              
                                </div>
                            </div>
                        
                    
                      

                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="button" onclick="storenotification()" value="حفظ" class="text-center">

                                </div>

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
<script>
	
 function storenotification(){
    $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      $.ajax({
          url:'storenoty',
          type:'post',
          dataType:'json',
          data:{
         'title': $("#title").val(),
         'text':$("#text").val(),
          
          },
          beforeSend:function(){
      Swal.fire(
  'يتم الان ارسال الاشعارات',
  'انتظر قليلا',

)        },
          success:function(result){
              if(result.status == true){
            Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم الاشعار بنجاح ',
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
      })
  }
  	function getstage(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getstage/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#year').empty();
    $('#year').html(result);
        $('#year').selectpicker('refresh');
       }

      });
    }
    	function getyear(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getyear/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#subject').empty();
    $('#subject').html(result);
        $('#subject').selectpicker('refresh');
       }

      });
    }
    
        


</script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/notifications/sendnoty.blade.php ENDPATH**/ ?>