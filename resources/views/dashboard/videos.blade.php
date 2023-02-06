@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
</style>
@endsection
@section('content')
        <!--start page-body-->
        <div class="page-body">
            <div class="container">
       <!--start heed-->
                           <div class="heed">

                    <div class="row">
                <div class="profile">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('images/profile.svg')}}">
                        </div>
                        <div class="col-6">
                            <h5>{{auth()->user()->name}}</h5>
                            <p>ادمن</p>

                        </div>

            
                            </div>
                        </div>
                        <div class="flag">

                            <div class="row">
                                <div class="col-4">
                                    <img src="{{asset('images/flag.svg')}}">
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
                                <p>{{ Carbon\Carbon::now()->format('d-m-Y')}}</p>
                            </div>
                        </div>


                    </div>


                </div>
                <!--end heed-->


                <!--start setting-->
                <div class="setting all-products typs">
                    <div class="container">
                        <div class="row def">

                            <img src="{{asset('images/all-products.svg')}}">
                            <h5>الفيديوهات</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-3">
                                    <button class="btn" >
                                      <a href="{{route('addvideo',$id)}}">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة فيديو  
                                        </a>
                                    </button>

                     

                                </div>

                                <div class="col-3">

                                </div>

                                
                                <div class="col-6">
                                    <button class="btn" >
                                      <a href="{{route('addvideospecial',$id)}}">  <span><i class="fas fa-plus-circle"></i></span>
                                        + اضافة فيديو من حصص سابقة 
                                        </a>
                                    </button>

                     
                              </div>



                                </div>

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                      <th scope="col" class="text-center">عنوان الفيديو</th>
                     <th scope="col" class="text-center">الفيديو</th>
                     <th scope="col" class="text-center">الصوره</th>
                     <th scope="col" class="text-center">الماده</th>
                    <th scope="col" class="text-center">السنه</th>
                    <th scope="col" class="text-center">المدرس</th>
                    <th scope="col" class="text-center">رقم الفيديو</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
                        
               
        
        
                        <tbody>
                    @foreach($videos as $video)
                    <tr id="video{{$video->id}}">
						<td scope="col" class="text-center">{{$video->id}}</td>
                         <td scope="col" class="text-center">{{$video->name_ar}}</td>
                <td scope="row" class="text-center">
                    <video width="120" height="120" src="{{ $video->url_link}}" controls></video>
             </td>
             <td scope="row" class='text-center'>
               @if($video->image)
                 <img src="{{url('uploads/'. $video->image)}}" style="width:120px;height:120px">
               @else
               لايوجد صوره
               @endif
             </td>
             <td scope="col" class="text-center">{{$video->subject->name_ar}}</td>
             <td scope="col" class="text-center">{{$video->year->year_ar}}</td>
             <td scope="col" class="text-center">{{$video->user->name}}</td>
                           <td scope="col" class="text-center">{{$video->order_number}}</td>
                        <td class="text-center">
                            <a href="{{route('editvideo',$video->id)}}" > <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                             @if(auth()->user()->hasPermission("videos-delete"))  
                             <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deletevideo('{{$video->id}}')" style="cursor:pointer;"> 
                          @endif
                               <span class="btn btn-success btn-sm" id="btn{{$video->id}}" onclick="activevideo({{$video->id}})">
                                 
                             @if($video->active == 1)
                             الغاء التفعيل
                             @else
                             تفعيل
                             @endif
                         </span>
                          <!-- <a href="{{route('videoexams',$video->id)}}"  class="btn btn-success btn-sm mt-2" >الكويزات</a> -->
                                            </td>
                                        </tr>                            
                     @endforeach
                     
                     
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
                        <h5>Made With <img src="{{asset('images/red.svg')}}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->


@endsection
@section("scripts")
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
	});function activevideo(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../../activevideo/${id}`,
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
  }  function deletevideo(sel){
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
       type:"get",
       url: `../deletevideo/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#video${id}`).remove();
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
         )
       }
           }
        
    });
    }
   
   
  })
}

</script>
@endsection