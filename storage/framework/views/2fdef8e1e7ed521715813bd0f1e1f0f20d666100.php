
<?php $__env->startSection('style'); ?>
<style>
    #example_wrapper{
        width: 100% !important;
    }
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align:start;
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
                <div class="serv-place">
                    <div class="container">

                        <div class="row def">
                            <img src="<?php echo e(asset('images/places.svg')); ?>">
                            <h5>المدن</h5>

                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-2 col-12"></div>
                            <div class="col-lg-4 col-6 form-group">
                            <select class="selectpicker  qeno-select form-control"  id="state"
                            data-live-search="true">
                                 <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <script>
                                $(function () {
                                    $('.selectpicker').selectpicker();
                                });
                                        </script>
                                    </div>
                
                            <div class="col-lg-4 col-6">
                                <input type="text" class="form-control" name="name" placeholder="المدينه" id="city">
                                <div id="alert"></div>
                            </div> 
                        </div>

                        <div class="row add">
                            <div class="col-12 text-center">
                                <button class="btn" id="btn" onclick="addcity()"  <?php if(auth()->user()->hasPermission("cities-create")): ?> <?php else: ?> disabled <?php endif; ?>>
                                    اضافة
                                    <span><i class="fas fa-download"></i></span>
                                    
                                </button>
                            </div>
                        </div>


                        <div class="tabl">
                               <table id="example" class="table table-borderless table-hover col-12" style="width:100%">
                                <thead>
                                  <tr>
									  <th>id</th>
                                    <th scope="col" class="text-center">المحافظه</th>
                                    <th scope="col" class="text-center">المدينه</th>
                                    <th scope="col" class="text-center">الاعدادات</th>
                                    
                                  </tr>
                                </thead>
                               <tbody>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="s<?php echo e($city['id']); ?>">
                                  <td scope="row" class="text-center"><?php echo e($city->id); ?></td>
                                    <td scope="row" class="text-center"><?php echo e($city->state['state']); ?></td>
                                    <td scope="row" class="text-center"><?php echo e($city->city); ?></td>
                                 
                                    <td class="text-center">
                                      <a href="<?php echo e(route('editcity',$city->id)); ?>">
                                            <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen"></a>
                                        <?php if(auth()->user()->hasPermission("cities-delete")): ?>  
                                 <img src="<?php echo e(asset('images/trash.svg')); ?>" id="trash" onclick="deletecity('<?php echo e($city->id); ?>')" style="cursor:pointer;"> 
                                      <?php endif; ?>
                                        
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
<script>
	function addcity(){

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"POST",
       url: `addcity`,
       data:{ 
        state_id:$("#state option:selected").val(),
        city:$('#city').val()
         },
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
        console.log(result);
        let id1 = result.id;
    $("tbody").prepend(`<tr id='s${result.data.id}'>
          <td scope="row" class="text-center">${result.data.state}</td>
         <td scope="row" class="text-center">${result.data.city}</td>
           
            <td class="text-center">
         
               <a href="editcity/${result.data.id}"> <img src="<?php echo e(asset('images/pen.svg')); ?>" id="pen"></a>
        <img src="<?php echo e(asset('images/trash.svg')); ?>" style="cursor:pointer;" id="trash" onclick="deletecity(${result.data.id})"></td>     
            </tr>`); 
    Swal.fire({
  position: 'top-start',
  icon: 'success',
  title:'تم اضافه المدينه بنجاح',
  showConfirmButton: false,
  timer: 1500
})
  
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


</script>
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
   function deletecity(sel){
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
       type:"post",
       url: `deletecity`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
         'id':id  
       },
       success: function(result){
    $(`#s${id}`).remove();
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
         )
       }

      });
    }
   
   
  })
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azcour/public_html/resources/views/dashboard/cities.blade.php ENDPATH**/ ?>