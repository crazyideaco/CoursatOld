
@php
    $student = \App\User::find($id);
@endphp
<td class="text-center">

        <img src="{{ asset('images/6-p.svg') }}" alt="" title="تسجيل الخروج" onclick="student_logout({{ $id }})">

    {{-- تفعيل المستخدم --}}
    @if ($active == 1)
    <img src="{{ asset('images/5-p.svg') }}" id="btn{{ $id }}" onclick="activeuser({{ $id }})" alt="" title="الغاء التفعيل">
    @else
    <img src="{{ asset('images/7-p.svg') }}" id="btn{{ $id }}" onclick="activeuser({{ $id }})" alt="" title="تفعيل">

    @endif
    {{-- تفعيل المستخدم --}}

    {{-- حذف المستخدم --}}
    <img src="{{ asset('images/trash.svg') }}" id="trash" onclick="deleteuser('{{ $id }}')"
        style="cursor:pointer;">
    {{-- حذف المستخدم --}}

    @if ($category_id == 1)
        <a class="resl"
            href="{{ route('typeresults_students', $id) }}">
            <img src="{{ asset('images/trash.svg') }}" alt="" title="نتائج

            الامتحانات">

            </a>
    @elseif($category_id == 2)
        <a class="resl"
            href="{{ route('typecollegeresults_students', $id) }}"><img src="{{ asset('images/trash.svg') }}" alt="" title="نتائج

            الامتحانات"></a>
    @endif


        <img src="{{ asset('images/3-p.svg') }}" alt="" title=" ريسيت باسورد الطالب " data-toggle="modal" data-target="#passwordModal{{ $id }}">




        <img src="{{ asset('images/2-p.svg') }}" alt="" title="كورسات الطالب"  data-toggle="modal" data-target="#cousesModal{{ $id }}">


</td>
<!-- The Modal -->
<div class="modal" id="passwordModal{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ريسيت الباسورد للطالب </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <label for="password{{ $id }}"> كلمة المرور</label>
                        <input id="password{{ $id }}" type="password" name="password" class="form-control"
                            placeholder="كلمة المرور">

                    </div>
                    <div class="col-8">
                        <label for="password_confirmation{{ $id }}">تأكيد كلمة المرور</label>
                        <input id="password_confirmation{{ $id }}"type="password"
                            name="password_confirmation" class="form-control" placeholder="تاكيد كلمة المرور">
                    </div>
                </div>
                <div class="row  mt-4">
                    <button type="button text-center" onclick="resetstudentPassword({{ $id }})"
                        class="btn btn-success">
                        حفظ
                    </button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="cousesModal{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">كورسات الطالب </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    @if ($student->stutypescollege)
                        <ul>
                            @foreach ($student->stutypescollege as $typecollege)
                                <li style="font-size:14px;">{{ $typecollege->name_ar }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($student->stutypes)
                        <ul>
                            @foreach ($student->stutypes as $type)
                                <li style="font-size:14px;">{{ $type->name_ar }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- var student_id = $(".student_id:checked").map(function() {
            return $(this).val();
        }).get() --}}
<script>
    //
    function resetstudentPassword(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.table').DataTable();
        $.ajax({
            type: "post",
            url: `resetStudentPassword/${id}`,
            //  contentType: "application/json; charset=utf-8",
            dataType: "Json",
            data: {
                'password': $(`#password${id}`).val(),
                'password_confirmation': $(`#password_confirmation${id}`).val(),
            },
            success: function(result) {
                if (result.status == true) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'تم تعديل الباسورد للطلاب بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    table.ajax().reload()

                    //location.reload();
                } else if (result.status == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,
                    })

                }
                $(`#myModal${id}`).modal('hide');



            }

        });
    }
</script>
