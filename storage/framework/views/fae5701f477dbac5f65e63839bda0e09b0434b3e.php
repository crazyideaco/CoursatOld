
<?php $__env->startSection('style'); ?>
<style>
    #example_wrapper {
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
                    <h5>الفئات</h5>



                </div>





                <div class="pt-5">
                    <div class="row">
                      <div class="table-responsive">
                        <table id="example" class="table col-12 p-0" style="width:100%, overflow-x:auto;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">الاسم</th>
                                    <th scope="col" class="text-center">الصوره</th>

                                    <th scope="col" class="text-center">الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="c<?php echo e($c->id); ?>">


                                    <td scope="col" class='text-center'><?php echo e($c->name); ?></td>
                                    <td scope="row" class='text-center'>
                                        <img src="<?php echo e(url('category/'. $c->image)); ?>" style="width:120px;height:120px">
                                    </td>
                                    <td> <a href="<?php echo e(route('editcategory',$c->id)); ?>"><img src="<?php echo e(asset('images/pen.svg')); ?>"></a>

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
        $('#example').DataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/category.blade.php ENDPATH**/ ?>