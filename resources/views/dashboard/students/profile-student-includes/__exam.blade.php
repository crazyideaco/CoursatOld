<div class="header-table">
    <h3>امتحانات</h3>
    <div class="form-group">
        <input type="date" id="exam_date" onclick="filter_exams({{ $student->id }})" class="form-control">
    </div>
</div>
<div class="table-responsive">
    <div class="table_details">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">اسم الامتحان</th>
                    <th scope="col">تارخ الامتحان</th>
                    <th scope="col">الدرجه</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1564115</th>
                    <td>المحاسبه</td>
                    <td>15/10/2023</td>
                    <td>30</td>
                </tr>
                <tr>
                    <th scope="row">1564115</th>
                    <td>المحاسبه</td>
                    <td>15/10/2023</td>
                    <td>30</td>
                </tr>
                <tr>
                    <th scope="row">1564115</th>
                    <td>المحاسبه</td>
                    <td>15/10/2023</td>
                    <td>30</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function filter_exams() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: `filtertypescollege`,
            //   contentType: "application/json; charset=utf-8",
            dataType: "Json",
            data: {
                "student_id": {{ $student->id }},
                "exam_date": $('#exam_date').val(),
            },
            success: function(result) {
                if (result.status == true) {
                    $('#example').DataTable().destroy();
                    $("#courses").empty();
                    $("#courses").append(result.data);
                    $('#example').DataTable().draw();
                }

            }

        });
    }
</script>
