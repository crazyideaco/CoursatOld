@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
	.serv-place .loc-add{
		margin-right: 0 !important;
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
                            <h5>السنوات</h5>

                        </div>


                        <form method="post" action="{{route('storeyears')}}">
                            @csrf
                        <div class="row loc-add">
                            <div class="col-lg-4 col-md-6 col-12 mt-3">
                                <select class="form-control" name="stage_id">
                                    <option value="0" disabled="disabled" selected="selected">ادخل مرحله</option>
                                    @foreach($stages as $stage)
                                    <option value="{{$stage->id}}">{{$stage->name_ar}}</option>
                                    @endforeach
                                </select>
                                @error('stage_id')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-3">
                                
     <input type="text"  value="{{old('year_ar')}}" class="form-control w-100" placeholder=" السنه بالعربى" name="year_ar"
                                >
                                @error('year_ar')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>
                            
                                 
                            <div class="col-lg-4 col-md-6 col-12 mt-3">
                             	<input type="text" value="{{old('year_en')}}" class="form-control w-100" placeholder=" السنه بالانجليزي" name="year_en"
                                    >
                                    @error('year_en')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>

                          <div class="col-lg-4 col-md-6 col-12 mt-3">
                               <label><input type="checkbox" value="1" name="sandl">علمى وادبى</label>
                            </div>
                        </div>
                         
                        <div class="row add">
                            <div class="col-12 text-center">
                                <button class="btn" id="btn" type="submit"  @if(auth()->user()->hasPermission("years-create"))  @else disabled @endif>
                                    اضافة
                                    <span><i class="fas fa-download"></i></span>
                                    
                                </button>
                            </div>
                        </div>

    </form>
                        <div class="table table-responsive">
                           <table id="example" class="table table-borderless table-hover col-12" style="width:100%">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text-center">السنه </th>
                                    <th scope="col" class="text-center"> المرحله</th> 
                                    <td scope="col" class="text-center">التخصص</td>
                                  <th scope="col" class="text-center">الاعدادات</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                              @foreach($years as $year)
                              <tr id="year{{$year->id}}">
                                  <td scope="col" class="text-center">{{$year->year_ar}}</td>
                                  <td scope="col" class="text-center">{{$year->stage->name_ar}}</td>
                                 
                                  <td scope="col" class="text-center"> 
                                   @if($year->sandl == 1)
                                  علمى وادبى
                                  @elseif($year->sandl ==0)
                        
                                       بلاتخصص 
                                       @endif
                                  </td>
                                      <td class="text-center">
                                      <a href="{{route('edityears',$year->id)}}">
                                            <img src="{{asset('images/pen.svg')}}" id="pen"></a>
                                          @if(auth()->user()->hasPermission("years-delete"))  
                                            <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deleteyear('{{$year->id}}')" style="cursor:pointer;"> 
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
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
   $(document).ready(function() {
    $('#example').DataTable();
} );
/*	$("#btn").click(function(e){
    e.preventDefault();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"POST",
       url: `storeservicesplaces`,
       data:{ 
        state:$("#state").val(),
        city:$("#city").val(),
         },
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
$("tbody").append(`<tr>
         <td scope="row" class="text-left">${result.state}</td>
            <td class="text-center">${result.city}</td>
            <td class="text-center">
                <img src="{{asset('images/pen.svg')}}" id="pen">
                <img src="{{asset('images/trash.svg')}}"></td>     
            </tr>`)
        
       }

      });
    });*/
 function deleteyear(sel){
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
       url: `deleteyear/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#year${id}`).remove();
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