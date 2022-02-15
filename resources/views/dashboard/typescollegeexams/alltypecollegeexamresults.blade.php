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
                            <h5>نتائج امتحانات الكورسات</h5>

                           
                    
                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                
                     



                                <div class="col-4">

                                </div>

                                  

                            </div>

                        </div>



                        <div class="pt-5">
                              <div class="row">
                            <span class="btn " style="margin:auto;border: 1px solid #222; border-radius: 5px;width:60%" onclick="fnExcelReport()">export</span>
                          </div>
                            <div class="row"style="overflow-x:auto !important;" >
                                                    
         <table id="example" class="table col-12" style="width:100%";overflow-x:auto;>
         <thead style="overflow-x:auto;">
                <tr>
					<th>id</th>
                <th scope="col" class="text-center">اسم الطالب</th>
              <th scope="col" class="text-center">  كود الطالب</th>
                     
                    <th scope="col" class="text-center"> الكورس</th>
                     <th scope="col" class="text-center"> الماده</th>
                     <th scope="col" class="text-center"> الجامعه</th>
                    <th scope="col" class="text-center"> الكليه</th>
                    <th scope="col" class="text-center"> القسم</th>
                    <th scope="col" class="text-center"> الفرقه</th>
                     <th scope="col" class="text-center"> الامتحان</th>
                   <th scope="col" class="text-center">درجه الامتحان</th>
                     <th scope="col" class="text-center">درجه الطالب</th>
                      <th scope="col" class="text-center"> التاريخ</th>
                </tr>
                        </thead>
          <tbody>
                    @foreach($examresults as $examresult)
                    <tr id="exam{{$examresult->id}}">
           
                 <td>{{$examresult->id}}</td>
                        <td  class="text-center">
                      
                 
                      {{$examresult->student->name}}
                      </td>
						   <td  class="text-center">
                      
                 
                      {{$examresult->student->code}}
                      </td>   <td  class="text-center">
                      
                 
                      {{$examresult->exam->typescollege->name_ar}}
                      </td>  <td  class="text-center">
                      
                 
                      {{$examresult->exam->subjectscollege->name_ar}}
                      </td>  <td  class="text-center">
                      
                 
                      {{$examresult->exam->university->name_ar}}
                      </td>  <td  class="text-center">
                      
                 
                      {{$examresult->exam->college->name_ar}}
                      </td>  <td  class="text-center">
                      
                 
                      {{$examresult->exam->division->name_ar}}
                      </td>  <td  class="text-center">
                      
                 
                      {{$examresult->exam->section->name_ar}}
                      </td>
                  
                           <td class="text-center">{{$examresult->exam->name}} </td>
                        <td class="text-center">{{$examresult->exam_score}} </td> 
                     <td class="text-center">{{$examresult->student_score}} </td>        
                               <td class="text-center">{{\Carbon\Carbon::parse($examresult->created_at)->format('Y-m-d')}} </td>  
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
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('example'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
@endsection