<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-coruses-tab" data-toggle="pill"
            href="#pills-coruses" role="tab" aria-controls="pills-coruses"
            aria-selected="true">الكورسات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-exams-tab" data-toggle="pill" href="#pills-exams"
            role="tab" aria-controls="pills-exams" aria-selected="false">الامتحانات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-History-tab" data-toggle="pill"
            href="#pills-History" role="tab" aria-controls="pills-History"
            aria-selected="false">History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-viwe-tab" data-toggle="pill" href="#pills-viwe"
            role="tab" aria-controls="pills-viwe" aria-selected="false">مشاهدات</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-coruses" role="tabpanel"
        aria-labelledby="pills-coruses-tab" onclick="get_courses({{ $student->id }})">

        @include('dashboard.students.profile-student-includes.__courses', [
            // 'courses' => $courses,
            // 'student' => $student,
        ])

    </div>
    <div class="tab-pane fade" id="pills-exams" role="tabpanel"
        aria-labelledby="pills-exams-tab">

        @include('dashboard.students.profile-student-includes.__exam')

    </div>
    <div class="tab-pane fade" id="pills-History" role="tabpanel"
        aria-labelledby="pills-History-tab">

        @include('dashboard.students.profile-student-includes.__history')

    </div>
    <div class="tab-pane fade" id="pills-viwe" role="tabpanel"
        aria-labelledby="pills-viwe-tab">

        @include('dashboard.students.profile-student-includes.__viwe')

    </div>
</div>
