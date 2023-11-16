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
                            <h5>حصص</h5>



                        </div>

                        <div class="products-search typs1">
                            <div class="row">
                                <div class="col-3">
                                    <button class="btn" >
                                      <a href="{{route('addlesson',$id)}}">  <span><i class="fas fa-plus-circle"></i></span>
                                        اضافه حصه
                                        </a>
                                    </button>


                              </div>


                                <div class="col-4">

                                </div>


   <div class="col-3">
                                    <button class="btn" >
                                      <a href="{{route('addspecialcollege',$id)}}">  <span><i class="fas fa-plus-circle"></i></span>
                           اضافه حصه مخصصه
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
					<td>id</td>
                      <td scope="col" class="text-center">اسم الحصه</td>
                    <td scope="col" class="text-center">اسم الكورس</td>
                    <td scope="col" class="text-center">اسم الماده</td>
                    <td scope="col" class="text-center">القسم</td>
                     <th scope="col" class="text-center">الفرقه</th>
                    <th scope="col" class="text-center">اسم الكليه</th>
                      <th scope="col" class="text-center">اسم الجامعه</th>
                  <th scope="col" class="text-center">رقم الحصه </th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                        </thead>
        <tbody>
                    @foreach($lessons as $lesson)

						 <tr id="un{{$lesson->id}}">
						 <td scope="row" class="text-center">
                   {{$lesson->id}}</td>
                          <td scope="row" class="text-center">
                             @if($lesson->status == 0)
                            <a href="{{route('videoscolleges',$lesson->id)}}">
                   {{$lesson->name_ar}}</a>
                           @else
                             {{$lesson->name_ar}}
                            @endif
                           </td>
                          <td scope="row" class="text-center">
                   {{$lesson->typescollege->name_ar}}</td>
                   <td scope="row" class="text-center">
                   {{$lesson->subjectscollege->name_ar}}</td>
                   <td scope="row" class="text-center">
                   {{$lesson->section->name_ar}}</td>
                <td scope="row" class="text-center">
                   {{$lesson->division->name_ar}}</td>
                    <td class="text-center">{{$lesson->college->name_ar}}</td>
                      <td class="text-center">{{$lesson->university->name_ar}}</td>
                           <td class="text-center">{{$lesson->order_number}}</td>
                        <td class="text-center">
                              @if($lesson->status == 0)
                  <a href="{{route('editlesson',$lesson->id)}}" class="d-block"> <img src="{{asset('images/pen.svg')}}" id="pen"
                         style="cursor: pointer"></a>
                          @else
                           <a href="{{route('editspecialcollege',$lesson->id)}}" class="d-block"> <img src="{{asset('images/pen.svg')}}" id="pen"
                         style="cursor: pointer"></a>
                          @endif
                          <span class="btn btn-success btn-sm d-block" id="btn{{$lesson->id}}" onclick="activelesson({{$lesson->id}})">
                             @if($lesson->active == 1)
                             الغاء التفعيل
                             @else
                             تفعيل
                             @endif
                         </span>
                                 <a class="btn btn-primary btn-sm mt-2" href="{{route('lessonexams',$lesson->id)}}">
                          الامتحانات
                         </a>
                              @if(auth()->user()->hasPermission("lessons-delete"))
									 <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deletelesson('{{$lesson->id}}')" style="cursor:pointer;">
                          @endif
                          <a href="{{route('lessonattendstudents',$lesson->id)}}"  class="btn btn-success btn-sm mt-2" >الحاضرين</a>
                          <span class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#myModal{{ $lesson->id }}">create qrcode</span>
                                            </td>
                                        </tr>
                                        <div class="modal" id="myModal{{ $lesson->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">create qrcode
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label>count </label>
                                                                <input class="form-control" value="1"
                                                                    id="count{{ $lesson->id }}">
                                                            </div>

                                                            <div class="col-12">
                                                                <label>expire date </label>
                                                                <input class="form-control" type="date"
                                                                    id="expire_date{{ $lesson->id }}">
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div id="qrcodes{{ $lesson->id }}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <button type="button" class="btn btn-success mx-auto"
                                                                onclick="store_qrcodes({{ $lesson->id }})">save</button>

                                                            <button class="btn btn-primary waves-effect waves-light mr-12"
                                                                type="button" onclick=" printDiv('qrcodes{{ $lesson->id }}');">
                                                                طباعة ال QR
                                                            </button>

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        function store_qrcodes(lesson_id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                data: {
                    'type_id': lesson_id,
                    'count': $(`#count${lesson_id}`).val(),
                    'expire_date': $(`#expire_date${lesson_id}`).val(),
                },
                url: `{{ route('store_lesson_qrcode') }}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(`#qrcodes${lesson_id}`).html(result.html);

                        // $(`#myModal${lesson_id}`).modal('hide');
                        // table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message
                        })
                    }
                }
            });
        }
    </script>
    <script>
        function printDiv(divName) {
            var PrintContent = document.getElementById(divName).innerHTML;
            const y = window.top.outerHeight / 2 + window.top.screenY - (530 / 2);
            const x = window.top.outerWidth / 2 + window.top.screenX - (400 / 2);
            var PrintWindow = window.open('', '',
                `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=400, height=530, top=${y}, left=${x}`
            );
            PrintWindow.document.write('<html><head></head><body>');
            PrintWindow.document.write(PrintContent);
            PrintWindow.document.write('</body></html>');
            setTimeout(function() {
                PrintWindow.focus();
                PrintWindow.print();
                PrintWindow.close();
            }, 500);
        }
    </script>
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
  function activelesson(id){
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../activelesson/${id}`,
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
  }function deletelesson(sel){
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
       type:"get",
       url: `../deletelesson/${id}`,
   //    contentType: "application/json; charset=utf-8",
//       dataType: "Json",
       success: function(result){
           if(result.status == true){
    $(`#un${id}`).remove();
     Swal.fire(
      'Deleted!',
      'تم مسح الحصه بنجاح',
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
