<?php

return [
    "auth_user_is_student" => [
        "student" => 1,
        "basic_lecturer" => 2,
        "doctor" => 3,
        "private_course_lecturer" => 4,
        "center" => 5,
    ],

    "system_category_type" => [
        "category_id_basic" => 1,
        "category_id_college" => 2,
        // "category_id_center" => 3,
    ],
    "video_type_link" => [
        "disk7" => 7,
        "disk6" => 6,
        "disk4" => 4,
        "disk3" => 3,
        "disk2" => 2,
        "disk1" => 1,
        "uploads" => 0,
    ],

    "storage_type" => [
        "Videocollege" => 1,

    ],

    "is_public_platform_or_private_platform" => [
        "public" => 1,
        "private" => 2,
    ],

    "pivot_type_in_student_type" => [
        "dashboard" => 4,
        "scan_qrcode" => 3,
        "subscription_request" => 2,
        "purchase" => 1,
        "subscription_default" => 0,
    ],
];
