<td class="text-center">
    <span class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px" onclick="student_logout({{ $id }})">
        تسجيل الخروج
    </span>
    <span
        class="btn  btn-sm"style="border:1px solid #222; margin-bottom:10px; padding:6px 45px"
        id="btn{{ $id }}"
        onclick="activeuser({{ $id }})">
        @if ($active == 1)
            الغاء التفعيل
        @else
            تفعيل
        @endif
    </span>
    <img src="{{ asset('images/trash.svg') }}" id="trash"
        onclick="deleteuser('{{ $id }}')"
        style="cursor:pointer;">
    @if ($category_id == 1)
        <a class="btnbtn-sm mt-2"
            style="border:1px solid #222; margin-bottom:10px; font-size:13px; display:block;    padding: 10px 10px; width: 60%; "
            href="{{ route('typeresults_students', $id) }}">نتائج
            الامتحانات</a>
    @elseif($category_id == 2)
        <a class="btn btn-sm mt-2"
            style="border:1px solid #222; margin-bottom:10px; padding:6px 20px"
            href="{{ route('typecollegeresults_students', $id) }}">نتائج
            الامتحانات</a>
    @endif
</td>
