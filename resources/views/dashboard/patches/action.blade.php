<?php
$teacher = \App\Models\Patch::whereId($id)->first();
?>

@switch($teacher->course_type)
    @case('Type')

    <a href="{{ route('types.qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a>
        {{-- Additional Blade code related to 'Type' --}}
        @break

    @case('TypesCollege')

    <a href="{{ route('typecolleges.typecollege_qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a>
        {{-- Additional Blade code related to 'TypesCollege' --}}
        @break

    @case('SubType')
    <a href="{{ route('subtype.subtype_qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a>
        {{-- Additional Blade code related to 'SubType' --}}
        @break

    @case('Lesson')
    <a href="{{ route('lesson.lesson_qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a>
        {{-- Additional Blade code related to 'Lesson' --}}
        @break

    @default
        {{-- Default case code... --}}
@endswitch



{{-- <a href="{{ route('types.qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a> --}}

