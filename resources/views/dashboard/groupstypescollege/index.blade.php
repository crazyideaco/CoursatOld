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
                            <h5>المجموعات</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-3">
                                    <button class="btn" >
                                  <a href="{{route('addgroupstypescollege',$id)}}">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة مجموعه  
                                        </a>
                                    </button>
                              </div>
                     



                                <div class="col-4">

                                </div>

                                  

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center">المجموعه</th>
                    <td scope="col" class="text-center">اسم الكورس</td>
                    <td scope="col" class="text-center">القسم</td>
                     <th scope="col" class="text-center">الفرقه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                    <th scope="col" class="text-center">اسم الجامعه </th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
          <tbody>
                    @foreach($groups as $group)
                    <tr id="group{{$group->id}}">
                  
						  <td class="text-center">{{$group->id}} </td>
                    <td  class="text-center">
                      
                 
                      {{$group->name_ar}}
                   </td>
                                     <td scope="row" class="text-center">
                   {{$group->typescollege->name_ar}}</td>
                   <td scope="row" class="text-center">
                   {{$group->section->name_ar}}</td>
                <td scope="row" class="text-center">
                   {{$group->division->name_ar}}</td>
                    <td class="text-center">{{$group->college->name_ar}}</td>
                          <td class="text-center">{{$group->university->name_ar}}</td>
                    
                     
                        <td class="text-center">
                     
                     
                                <a href="{{route('editgroupstypescollege',$group->id)}}" > <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                      
                           <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deletegroup('{{$group->id}}')" style="cursor:pointer;"> 
                     <a href="{{route('grouptypescollegelivelessons',$group->id)}}" class="btn btn-success btn-sm" >حصص لايف</a>
                          
                           <a href="{{route('groupstypescollegestudents',$group->id)}}" class="btn btn-success btn-sm mt-2" >الطلاب </a>
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
//   $(document).ready(function() {
    $('#example').DataTable({
	"order": [[ 0, "desc" ]], // Order on init. # is the column, starting at 0});
  columnDefs: [
      {
         targets: 0,
      visible : false,
        
     
      },]
           
});
//	});
function deletegroup(sel){
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
       url: `../deletegroupstypescollege/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#group${id}`).remove();
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