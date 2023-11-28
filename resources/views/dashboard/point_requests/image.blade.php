@php
    $point = \App\Models\PointRequest::whereId($id)->first();
@endphp

@if ($image != null)
    <img src="{{ $point->image_link }}'" style="width: 50px; height: 50px;">'
@endif
