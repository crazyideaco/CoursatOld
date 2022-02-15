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
                            <h5>الباقات </h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <button class="btn w-100 mx-auto" >
                                      <a href="{{route('addpaqas')}}">  <span><i class="fas fa-plus-circle"></i></span>
                                اضافه باقه  
                                        </a>
                                    </button>

                     



                                <div class="col-4">

                                </div>

                                



                                </div>

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                     <div class="table-responsive">
                                                   
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr >
					<th>id</th>
                     <th scope="col" class="text-center">اسم الباقه</th>
 
                    <th scope="col" class="text-center">الحجم</th>
                
                      <th scope="col" class="text-center">القيمه</th>
                      
                          <th scope="col" class="text-center">النوع</th>



                <th scope="col" class="text-center">عدد المستخدمين</th>

                <th scope="col" class="text-center">السعر</th>

              
                <th scope="col" class="text-center">التاريخ</th>
              <th></th>
              
              
                </tr>
                        </thead>
        <tbody>
                    @foreach($paqa as $p)
                    <tr id="c{{$p->id}}">
						    <td scope="row"class="text-center"> {{$p->id}}</td>
               <td scope="row"class="text-center"> {{$p->name}}</td>

                <td scope="row" class="text-center">{{$p->size}}</td>
                <?php
                if($p->type==1){
                   $type="يوم"; 
                }else if($p->type==2){
                     $type="شهر";
                }else if($p->type==3){
                    $type="سنه";
                }
                ?>
                <td scope="row"class="text-center">{{$p->value}}</td>
                <td scope="row"class="text-center">{{$p->type}}</td>
                <td scope="row"class="text-center">{{$p->num_users}}</td>
                <td scope="row"class="text-center">{{$p->price}}</td>
                <td scope="row"class="text-center">{{$p->date}}</td>
               <td class="text-center">
                  <a href="{{route('editpaqas',$p->id)}}"> <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                 @if(auth()->user()->hasPermission("paqas-delete"))
                    <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deletepaqas('{{$p->id}}')" style="cursor:pointer;"> 
                 @endif
                                        </tr>                            
                                        @endforeach
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
	});
function deletepaqas(sel){
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
 
       url: `deletepaqas/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#c${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الباقه بنجاح',
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