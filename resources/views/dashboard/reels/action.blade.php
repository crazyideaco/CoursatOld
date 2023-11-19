<?php
?>

<td class="button">

    {{-- <a class="btn show" href="{{route('students.show',$student->id)}}"> <i
            class="bi bi-eye"></i></a> --}}

    <a class="btn edit" href="{{route('reels.edit',$id)}}"> <i
            class="bi bi-pencil"></i></a>

    {{-- <button class="btn block" href="#"> <i class="bi bi-slash-circle"></i></button> --}}

    <button type="button" onclick="deletereels({{$id}})" class="btn delete" >
        <i class="bi bi-trash3"></i></button>

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
            title: "{{__('messages.areyousure')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "{{__('messages.cancel')}}",
            confirmButtonText: "{{__('messages.yessure')}}",
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
                                "{{__('messages.deleted')}}",
                                "{{__('messages.donedelete')}}",
                                'success'
                            )
                            table.ajax.reload();
                        }
                    }
                });
            }
        })
    }
