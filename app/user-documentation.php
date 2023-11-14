<?php



if ($request->is_primary == 1) {
    $user->category_id = 1; // basic

    $user->stage_id = $request->stage_id;
    $user->year_id = $request->year_id;
    $user->is_scientific = $request->is_scientific;
    $user->info_compelete = 1;
} elseif ($request->is_primary == 0) {
    $user->category_id = 2; // college

    $user->university_id = $request->university_id;
    $user->college_id = $request->college_id;
    $user->division_id = $request->department_id;
    $user->section_id = $request->college_year_id;
    $user->info_compelete = 1;
}
