<?php
$join = \App\TypecollegeJoin::whereId($id)->first();
?>

<div id="status{{$join->id}}">
    @if($join->status == 0)

<button type="button"  class="btn btn-success
 btn-light-success w-30" onclick="accept_typecollege_join({{$join->id}})">
                   قبول </button>
                   <button type="button"  class="btn btn-danger
 btn-light-danger w-30 "  onclick="refuse_typecollege_join({{$join->id}})">
                   رفض </button>

    @elseif($join->status == 1)
    <span class="badge badge-success p-2">تم القبول</span>
    @elseif($join->status == 2)
    <span class="badge badge-danger p-2">تم الرفض</span>
                   @endif
                   </div>


<script>
    function accept_typecollege_join(sel){
    let id = sel;

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `accept_typecollege_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
      result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-success p-2">تم القبول</span>');
       }
           }

    });
    }function refuse_typecollege_join(sel){
    let id = sel;

 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
       type:"get",
       url: `refuse_typecollege_join/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'تم!',
         result.message,
      'success'
         )
         $(`#status${id}`).empty();
         $(`#status${id}`).html('<span class="badge badge-danger p-2">تم الرفض</span>');
       }
           }

    });
    }
</script>
