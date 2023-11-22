<?php
$point = \App\Models\PointRequest::whereId($id)->first();
?>

<div id="status{{ $point->id }}">
    @if ($point->status == 0)
        <button type="button" class="btn btn-success
 btn-light-success w-30"
            onclick="accept_point_request({{ $point->id }})">
            قبول </button>
        <button type="button" class="btn btn-danger
 btn-light-danger w-30 "
            onclick="refuse_point_request({{ $point->id }})">
            رفض </button>
    @elseif($point->status == 1)
        <span class="badge badge-success p-2">تم القبول</span>
    @elseif($point->status == 2)
        <span class="badge badge-danger p-2">تم الرفض</span>
    @endif
</div>


<script>
    function accept_point_request(sel) {
        let id = sel;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: `accept_point_request/${id}`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                if (result.status == true) {
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
    }

    function refuse_point_request(sel) {
        let id = sel;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: `refuse_point_request/${id}`,
            //    contentType: "application/json; charset=utf-8",
            dataType: "Json",
            success: function(result) {
                if (result.status == true) {
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
