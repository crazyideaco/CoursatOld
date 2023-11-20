<?php
?>

<td class="button">

    {{-- <a class="btn show" href="{{route('students.show',$student->id)}}"> <i
            class="bi bi-eye"></i></a> --}}

            <a href="{{route('reels.edit',$id)}}"> <img src="{{asset('images/pen.svg')}}" id="pen"
                style="cursor: pointer"></a>
    {{-- <button class="btn block" href="#"> <i class="bi bi-slash-circle"></i></button> --}}

    <button type="button" onclick="deletereels({{$id}})"  >
        مسح</button>

</td>

<script>
    function deletereels(id){

        var table = $('.dataTable').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Swal.fire({
            title: "هل انت متأكد",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "الغاء",
            confirmButtonText: "نعم",
        }).then((result) => {
            if (result.isConfirmed) {


                $.ajax({
                    type:'POST',
                    data:{
                        '_method': 'DELETE',
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: `reels/${id}`,
                    dataType: "Json",
                    success: function(result){
                        if(result.status == true){
                            Swal.fire(
                                "تم المسح",
                                "تما المسح بنجاح",
                                'success'
                            )
                            table.ajax.reload();
                        }
                    }
                });
            }
        })
    }
