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
                                <img src="{{ asset('images/profile.svg') }}">
                            </div>
                            <div class="col-6">
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>ادمن</p>

                            </div>


                        </div>
                    </div>
                    <div class="flag">

                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('images/flag.svg') }}">
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
                            <p>{{ Carbon\Carbon::now()->format('d-m-Y') }}</p>
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
                        <h5>الطلاب</h5>
                        <form action="{{ route('unverifiedstudents') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-success">تفعيل كل الطلاب</button>
                        </form>


                    </div>

                    <div class="products-search typs1">


                    </div>



                    <div class="pt-5">

                        <div class="row">
                            <div class="table-responsive">

                                <table id="example" class="table col-12" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th scope="col" class="text-center">الاسم</th>
                                            <th scope="col" class="text-center">الكود</th>
                                            <th scope="col" class="text-center">الهاتف</th>
                                            <th scope="col" class="text-center">المرحلة</th>
                                            <th scope="col" class="text-center">الفرقة</th>
                                            <th scope="col" class="text-center">تاريخ الإنضمام</th>
                                            <!--	<th scope="col" class="text-center">المدينه</th>-->

                                            <!--  <th scope="col" class="text_center">السنه</th>-->
                                            <th scope="col" class="text-center">الاعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students">
                                        @foreach ($students as $student)
                                            <tr id="s{{ $student->id }}">

                                                <th>{{ $student->id }}</th>
                                                <td scope="col" class='text-center'>{{ $student->name }}</td>
                                                <td scope="col" class='text-center'>{{ $student->code }}</td>
                                                <td scope="col" class='text-center'>{{ $student->phone }}</td>
                                                <td scope="col" class='text-center'>
                                                    {{ $student->stage->name_ar ?? '' }}
                                                    {{-- @if ($student->is_student == 1)
                                                        {{ $student->stage?->name_ar ?? '' }}
                                                    @else
                                                        {{ $student->college?->name_ar ?? '' }}
                                                    @endif --}}
                                                </td>
                                                <td scope="col" class='text-center'>
                                                    {{ $student->year->year_ar ?? '' }}
                                                    {{-- @if ($student->is_student == 1)
                                                        {{ $student->year?->year_ar }}
                                                    @else
                                                        {{ $student->section?->name_ar }}
                                                    @endif --}}
                                                </td>
                                                <td scope="col" class='text-center'>{{ $student->created_at->format('d-m-Y') }}</td>

                                                <td class="text-center">

                                                    @if ($student->phone_verify != 1)
                                                        <span class="btn btn-success btn-sm phone_verify{{ $student->id }}"
                                                            onclick="phone_verify({{ $student->id }})">
                                                            phone verify
                                                        </span>
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
                        <h5>Made With <img src="{{ asset('images/red.svg') }}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#example').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                }, ] // Order on init. # is the column, starting at 0

            });
        });

        function phone_verify(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `phone_verify/${id}`,
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم  بنجاح ',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(`.phone_verify${id}`).remove();
                    }

                }

            });
        }
    </script>
@endsection
