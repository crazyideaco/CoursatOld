<div class="header-table">
    <h3>كورسات</h3>
    <div class="form-group">
        <input type="date" class="form-control">
    </div>
</div>
<div class="table-responsive">
    <div class="table_details">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">اسم الكورس</th>
                    <th scope="col">تاريخ اشتراك الكورس</th>
                    <th scope="col">نوع الاشتراك</th>
                    <th scope="col">نوع المنصه</th>
                    <th scope="col"></th>


                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name_ar }}</td>
                        <td>{{ $item->pivot('created_at') }}</td>
                        <td>{{ $item->pivot('type') }}</td>
                        <td>{{ $item->center_id ? $item->center->name : '--' }}</td>
                        @if ($student->category_id == config('project_types.system_category_type.category_id_college'))
                            <td onclick="deleteuser_from_stutypescollege({{ $student->id }},{{ $item->id }})"
                                title="حذف الطالب من هذا الكورس"><i class="fas fa-trash-alt delet"></i></td>
                        @elseif ($student->category_id == config('project_types.system_category_type.category_id_basic'))
                            <td onclick="deleteuser_from_stutypes({{ $student->id }},{{ $item->id }})"
                                title="حذف الطالب من هذا الكورس"><i class="fas fa-trash-alt delet"></i></td>
                        @endif
                    </tr>
                @endforeach
                {{-- <tr>
                    <th scope="row">1564115</th>
                    <td>المحاسبه</td>
                    <td>15/10/2023</td>
                    <td>--</td>
                    <td>--</td>
                    <td><i class="fas fa-trash-alt delet"></i></td>

                </tr>
                <tr>
                    <th scope="row">1564115</th>
                    <td>المحاسبه</td>
                    <td>15/10/2023</td>
                    <td>--</td>
                    <td>--</td>
                    <td><i class="fas fa-trash-alt delet"></i></td>

                </tr> --}}
            </tbody>
        </table>
    </div>
</div>
