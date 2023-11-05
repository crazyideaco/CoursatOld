<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'teachers' => 'c,r,u,d',
            'doctors' => 'c,r,u,d',
            'lecturer' => 'c,r,u,d',
            'centers' => 'c,r,u,d',
            'states' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'offers' =>'c,r,u,d',
            'sendnotification' => 'c',
             'sendnotificationbasic' => 'c',
           'sendnotificationuniversity' => 'c',
           'sendnotificationgeneral' => 'c',
           'points' => 'u',
           'pointscash' => 'c',
           'messages' => 'r',
            'stages' => 'c,r,u,d',
            'years' => 'c,r,u,d',
            'subjects' => 'c,r,u,d',
          'types' =>'c,r,u,d',
          'subtypes' =>'c,r,u,d',
          'videos' =>'c,r,u,d',
          'userpaqa' => 'c,r',
          'subjectquestionsscenter' => 'c,r,u,d',
          'universities' => 'c,r,u,d',
          'colleges' => 'c,r,u,d',
          'divisions' => 'c,r,u,d',
           'sections' => 'c,r,u,d', 
          'subcolleges' => 'c,r,u,d',
           'typescolleges' => 'c,r,u,d',
           'lessons' => 'c,r,u,d', 
          'videoscolleges' => 'c,r,u,d',
          'subjectscollegequestionscenter'=> 'c,r,u,d',
           'general' => 'c,r,u,d',
           'sub' => 'c,r,u,d',
           'course' => 'c,r,u,d', 
          'videosgeneral' => 'c,r,u,d',
          'subquestioncenterss'=> 'c,r,u,d',
          'paqas' => 'c,r,u,d',
          'students' => 'r,d'
        ],
        'admin' => [
           
        ],
       
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
