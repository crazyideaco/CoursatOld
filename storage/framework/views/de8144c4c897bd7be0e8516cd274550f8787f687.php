
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
                            <h5>اضافه نقاط</h5>
                        </div>
                            <form method="post" action="<?php echo e(route('storepoints',$point->id)); ?>" enctype="multipart/form-data">
                        	<?php echo csrf_field(); ?>
                           
                        </div>
                        <div class="info">
                            <div class="row">
                          
                             
                     <div class="form-group col-lg-4 col-6">
                                     
                                   <label for="pay">النقاط</label><br >
                                   <input id="pay" style="height:35px;" type="number"  value="1" disabled="disabled"
                                   name="pointd">
                                   <input type="hidden" type="number"  value="1" disabled="disabled"
                                   name="point">
                                 
                               </div>
                               
                                <div class="form-group col-lg-4 col-6">
                                     
                                   <label for="pay2">القيمه</label><br >
                                   <input id="pay2" style="height:35px;" type="number"  value="<?php echo e($point->value); ?>" name="value">
                                 
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

<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/addpoints.blade.php ENDPATH**/ ?>