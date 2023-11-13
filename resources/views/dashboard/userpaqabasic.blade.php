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

                            <img src="images/all-products.svg">
                            <h5>الاشتراكات </h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                    <button class="btn" >
                                        @if($type==1)
                                      <a href="{{route('addpaqabasic')}}">  <span><i class="fas fa-plus-circle"></i></span>
                                اضافه اشتراك  
                                        </a>
                                        
                                        @elseif($type==2)
                                        
                                                      <a href="{{route('addpaqacollage')}}">  <span><i class="fas fa-plus-circle"></i></span>
                                اضافه اشتراك  
                                        </a>
                                        @elseif($type==3)
                                        
                                                      <a href="{{route('addpaqapublic')}}">  <span><i class="fas fa-plus-circle"></i></span>
                                اضافه اشتراك  
                                        </a>
                                        @endif
                                    </button>
                                

                            </div>

                        </div>



                        <div class="pt-5">
                            <div class="row">
                                                    
         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
                  <th scope="col" >id</th>
                     <th scope="col" class="text-center">الاسم</th>
                     <th scope="col" class="text-center">الباقه</th>
                  <th scope="col" class="text-center">تاريخ الانتهاء</th>
                       <th></th>
              
                </tr>
                        </thead>
        <tbody>
                    @foreach($user as $p)
            <?php
              $paqauser=App\Paqa_User::where('user_id',$p->id)->first();

              if($paqauser != null){
              $paqa=App\Paqa::where('id',$paqauser->paqa_id)->first();
              $name=$paqa->name;
              $user=$p->name;
                $id = $paqauser->id;
              }
                ?>
           @if($paqauser != null)
                    <tr>

              
                      <td>{{$id}}</td>
                               <td scope="row"class="text-center"> {{$user}}</td>

                <td scope="row"class="text-center">{{$name}}</td>
                       <td scope="row"class="text-center">{{$paqauser->expired_at}}</td>
               <td>  @if($type==1)
                                      <a href="{{route('editpaqabasic',$paqauser->id)}}">  <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                                        
                                        @elseif($type==2)
                                        
                                                      <a href="{{route('editpaqacollage',$paqauser->id)}}">   <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                                        @elseif($type==3)
                                        
                                                      <a href="{{route('editpaqapublic',$paqauser->id)}}"> <img src="{{asset('images/pen.svg')}}" id="pen" 
                         style="cursor: pointer"></a>
                                        @endif</td>
                                        </tr>        
          @endif
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
    "order": [[ 0, "desc" ]],
			"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
            },
        ]// Order on init. # is the column, starting at 0

});
} );
</script>
@endsection