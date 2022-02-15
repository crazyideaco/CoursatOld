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
                <div class="serv-place">
                    <div class="container">

                        <div class="row def">
                            <img src="{{asset('images/places.svg')}}">
                            <h5>المحافظات</h5>

                        </div>


                       
                        <div class="row loc-add">
                            <div class="col-12">
                                <input type="text" class="form-control" name="name" placeholder="المحافظه" id="state">
                    <div id="alert"></div>
                            </div> 
                        </div>

                        <div class="row add">
                            <div class="col-12 text-center">
                           
                                <button class="btn" id="btn" onclick="addstate()"    @if(auth()->user()->hasPermission("states-create")) @else disabled @endif>
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
                                    <th scope="col" class="text-center">الاعدادات</th>
                                    
                                  </tr>
                                </thead>
                               <tbody>
                                  @foreach($states as $state)
                                  <tr id="c{{$state['id']}}">
									  <td>{{$state->id}}</td>
                                    <td scope="row" class="text-center">{{$state->state}}</td>
                                 
                                    <td class="text-center">
                                      <a href="{{route('editstate',$state->id)}}">
                                            <img src="{{asset('images/pen.svg')}}" id="pen"></a>
                          @if(auth()->user()->hasPermission("states-delete"))       <img src="{{asset('images/trash.svg')}}" id="trash"  >
                                      @endif
                                        
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
<script>
function addstate(){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"POST",
       url: `addstate`,
       data:{ 
        state:$("#state").val(),
         },
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
        console.log(result.id);
        let id1 = result.id;
        $("#alert").empty();
        $("#state").empty();
    $("tbody").prepend(`<tr id='c${result.data.id}'>
         <td scope="row" class="text-center">${result.data.state}</td>
           
            <td class="text-center">
         
               <a href="editstate/${result.data.id}"> <img src="{{asset('images/pen.svg')}}" id="pen"></a>
        <img src="{{asset('images/trash.svg')}}" style="cursor:pointer;" id="trash" onclick="deletestate(${result.data.id})"></td>     
            </tr>`);
               Swal.fire({
  position: 'top-start',
  icon: 'success',
  title: 'تم اضافه المحافظه بنجاح',
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
   function deletestate(sel){
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
       type:"post",
       url: `deletestate`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           'id':sel
       },
       success: function(result){
           if(result.status == true){
    $(`#c${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح المحافظه بنجاح',
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