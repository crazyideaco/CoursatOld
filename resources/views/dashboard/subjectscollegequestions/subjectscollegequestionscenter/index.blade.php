@extends('App.dash')
@section('style')
<style>
    #example_wrapper{
        width: 100% !important;
    }
	.all-products #btn1{
		margin-right: 0 !important;
	}
	.all-products #btn2{
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
                     <h5>  بنك اسئله الماده </h5>



                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <button class="btn w-100 mx-auto" >
                                      <a href="{{route('addsubjectscollegequestionscenter')}}">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافة   سؤال
                                        </a>
                                    </button>

                                <div class="col-4">

                                </div>

                                </div>

                            </div>

                        </div>
                       @if(Auth::user() && Auth::user()->isAdmin == 'admin')

<div class="row">
     <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" required class="form-control" id="university" onchange="getcolleges(this)">
                                       <option value="0" >اختر جامعه</option>
                                       @foreach($universities as $university)
                                       <option value="{{$university->id}}">
                                           {{$university->name_ar ?? ""}}
                                           </option>
                                       @endforeach
                                   </select>
                                    @error('university_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" required class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="0"  >اختر كليه</option>
                                       @foreach($colleges as $college)
                                       <option value="{{$college->id}}">{{$college->name_ar ?? ""}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" required class="form-control" id="division" onchange="getsection(this)">
                                       <option value="0"  >اختر قسم</option>
                                       @foreach($divisions as $division)
                                       <option value="{{$division->id}}">{{$division->name_ar ?? ""}}</option>
                                       @endforeach
                                   </select>
                                </div>
          <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" required class="form-control" id="section" onchange="getsubcollege(this)" >
                                       <option value="0"  >اختر فرقه</option>
                                       @foreach($sections as $section)
                                       <option value="{{$section->id}}">{{$section->name_ar ?? ""}}</option>
                                       @endforeach
                                   </select>
                                </div>
                      </div>
                      <div class="row">

                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده </label>
                                   <select name="subjectscollege_id" required class="form-control" id="subcollege" onchange="getdoctor(this)" >
                                       <option value="0" >اختر ماده</option>
                                       @foreach($subcolleges as $subcollege)
                                       <option value="{{$subcollege->id}}">{{$subcollege->name_ar ?? ""}}</option>
                                       @endforeach
                                   </select>
                                </div>
                      </div>

      <div class="row">
                            <div class="col-3 mx-auto">


                            <span class="btn btn-primary" onclick="filtersubjectscollegequestion()">بحث</span>    </div>
                          </div>
@endif
                        <div class="pt-5">
                            <div class="row">
                                     <div class="table-responsive">

         <table id="example" class="table col-12" style="width:100%">
   <thead>
                <tr>
					<th>id</th>
                     <th scope="col" class="text-center"> قسم الاسئله  </th>

                  <td scope="col" class="text-center">اسم الماده</td>
                    <td scope="col" class="text-center">القسم</td>
                     <th scope="col" class="text-center">الفرقه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                    <th scope="col" class="text-center">اسم الجامعه </th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody id="typescolleges">
                    @foreach($questions as $question)
                    <tr id="type{{$question->id}}">
						  <td class="text-center">{{$question->id}}</td>
                    <td scope="row" class="text-center">{{$question->name}}</td>
                    <td scope="row" class="text-center">
                   {{$question->subjectscollege->name_ar ?? ""}}</td>
                   <td scope="row" class="text-center">
                   {{$question->section->name_ar ?? ""}}</td>
                <td scope="row" class="text-center">
                   {{$question->division->name_ar ?? ""}}</td>
                    <td class="text-center">
                      @if($question->college)
                      {{$question->college->name_ar ?? ""}}
                      @endif
                      </td>
                          <td class="text-center">
                            @if($question->university)
                            {{$question->university->name_ar ?? ""}}
                      @endif</td>
                        <td class="text-center">
                          <a href="{{route('editsubjectscollegequestionscenter',$question->id)}}" > <img src="{{asset('images/pen.svg')}}" id="pen"
                         style="cursor: pointer"></a>
                              @if(auth()->user()->hasPermission("subjectscollegequestionscenter-delete"))
                             <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deletetype('{{$question->id}}')" style="cursor:pointer;">
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
function activetype(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `activetype/${id}`,
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
  } function deletetype(sel){
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
       url: `../deletesubjectscollegequestionscenter/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#type${id}`).remove();
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
}  function getcolleges(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       console.log(result);
       }

      });
    }
  function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
       }

      });
  }
  function getsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  } function getsubcollege(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsubcollege/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#subcollege').empty();
    $('#subcollege').html(result);
       }

      });
  }  function filtersubjectscollegequestion(){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"post",
       url: `filtersubjectscollegequestion`,
      //   contentType: "application/json; charset=utf-8",
       dataType: "Json",
      data:{
          "university_id":$("#university").val(),
          "college_id":$("#college").val(),
          "division_id":$("#division").val(),
          "section_id":$("#section").val(),
          "subjectscollege_id":$("#subcollege").val(),

      },
       success: function(result){
    if(result.status == true){
       $('#example').DataTable().destroy();
      $("#typescolleges").empty();
      $("#typescolleges").append(result.data);
       $('#example').DataTable().draw();
    }

       }

      });
  }
</script>
@endsection
