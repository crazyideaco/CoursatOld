@extends('App.dash')
@section('style')
<style>
    #example_wrapper {
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
                    <h5>admins</h5>



                </div>

                <div class="products-search typs1">
                    <div class="row">
                            <button class="btn">
                                <a href="{{route('addadmin')}}"> <span><i class="fas fa-plus-circle"></i></span>
                                    اضافه ادمن
                                </a>
                            </button>

                        </div>

                    </div>

                </div>



                <div class="pt-5">
                    <div class="row">
                            <table id="example" class="table col-12 table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">الاسم</th>
                                        <th scope="col" class="text-center">الايميل </th>
                                        <th scope="col" class="text-center">الهاتف</th>
                                        <th scope="col" class="text-center">الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                    <tr id="c{{$admin->id}}">


                                        <td scope="col" class='text-center'>{{$admin->name}}</td>
                                        <td scope="col" class="text-center">

                                            {{$admin->email}}
                                        </td>

                                        <td scope="col" class="text-center">

                                            {{$admin->phone}}
                                        </td>
                                        <td scope="col" class="text-center">
                                            <a href="{{route('editadmin',$admin->id)}}">
                                                <img src="{{asset('images/pen.svg')}}" id="pen"></a>
                                            @if(auth()->id() != $admin->id)
                                            <span class="btn btn-success btn-sm" id="btning{{$admin->id}}" onclick="activeuser({{$admin->id}})">
                                                @if($admin->active == 1)
                                                الغاء التفعيل
                                                @else
                                                تفعيل
                                                @endif
                                            </span>
                                            <img src="{{asset('images/trash.svg')}}" id="trash" onclick="deleteuser('{{$admin->id}}')" style="cursor:pointer;">
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
    });

    function activeuser(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `activeuser/${id}`,
            contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                if (result.status == 'deactive') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم الغاء التفعيل ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(`#btning${id}`).html('تفعيل');

                } else if (result.status == 'active') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم التفعيل  ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(`#btning${id}`).html('الغاء التفعيل');

                }

            }

        });
    }

    function deleteuser(sel) {
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

                    url: `deleteuser/${id}`,
                    //    contentType: "application/json; charset=utf-8",
                    dataType: "Json",
                    success: function(result) {
                        if (result.status == true) {
                            $(`#c${id}`).remove();
                            Swal.fire(
                                'Deleted!',
                                'تم مسح المستخدم بنجاح',
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