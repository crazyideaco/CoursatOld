<?php
$teacher = \App\Models\Patch::whereId($id)->first();
?>

<a href="{{ route('types.qrcodes', $teacher->id) }}" title="qr codes"
        class="text-dark ml-2"><i class="fas fa-cog"></i></a>

