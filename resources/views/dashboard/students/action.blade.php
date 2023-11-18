<td class="text-center">
    <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px"
        onclick="student_logout({{ $id }})">
        تسجيل الخروج
    </span>
    <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px"
        id="btn{{ $id }}" onclick="activeuser({{ $id }})">
        @if ($active == 1)
            الغاء التفعيل
        @else
            تفعيل
        @endif
    </span>
    <img src="{{ asset('images/trash.svg') }}" id="trash" onclick="deleteuser('{{ $id }}')"
        style="cursor:pointer;">
    @if ($category_id == 1)
        <a class="btnbtn-sm mt-2"
            style="border:1px solid #222; margin-bottom:10px; font-size:13px; display:block;    padding: 10px 10px; width: 60%; "
            href="{{ route('typeresults_students', $id) }}">نتائج
            الامتحانات</a>
    @elseif($category_id == 2)
        <a class="btn btn-sm mt-2" style="border:1px solid #222; margin-bottom:10px; padding:6px 20px"
            href="{{ route('typecollegeresults_students', $id) }}">نتائج
            الامتحانات</a>
    @endif
    <button type="button" class="btn btn-sm mt-2" style="border:1px solid #222; margin-bottom:10px; padding:6px 20px" data-toggle="modal"
        data-target="#passwordModal{{ $id }}">
        ريسيت باسورد الطالب
    </button>
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
                        <input id="password{{ $id }}" type="password" name="password" class="form-control" placeholder="كلمة المرور" >

                    </div>
                    <div class="col-8">
                        <label for="password_confirmation{{ $id }}">تأكيد كلمة المرور</label>
                        <input  id="password_confirmation{{ $id }}"type="password" name="password_confirmation" class="form-control" placeholder="تاكيد كلمة المرور">
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
