<?php
return [
    'front' => [
        'links' => [
            [
                'name' => 'Home',
                'route' => 'home',
                'url' => '/',
                'active' => 'home',
            ],
            [
                'name' => 'About',
                'route' => 'about',
                'url' => '/about',
                'active' => 'about',
            ],
            [
                'name' => 'Courses',
                'route' => 'courses',
                'url' => '/courses',
                'active' => 'courses',
            ],
            [
                'name' => 'Pages',
                'route' => 'contact',
                'url' => '/courses',
                'active' => 'pages.*',
            ],
            [
                'name' => 'Contact',
                'route' => 'contact',
                'url' => '/contact',
                'active' => 'contact',
            ],
        ],
        'pages' => [
            // [
            //     'name' => 'Course Detail',
            //     'route' => 'pages.courseDetail',
            //     'url' => '/pages/coursesDetails',
            //     'active' => 'pages.courseDetail',
            // ],
            [
                'name' => 'Our Features',
                'route' => 'pages.features',
                'url' => '/pages/featcures',
                'active' => 'pages.features',
            ],
            [
                'name' => 'Instructors',
                'route' => 'pages.instructors',
                'url' => '/pages/instructors',
                'active' => 'pages.instructors',
            ],
            [
                'name' => 'Testimonial',
                'route' => 'pages.testimonials',
                'url' => '/pages/testimonails',
                'active' => 'pages.testimonials',
            ],
        ],
    ],
    'dashboard' => [
        'instructor' => [
            [
                'title' => 'dashboard',
                'icon' => 'fas fa-home',
                'route' => 'dashboard.instructor.dashboard.index',
                'active' => 'dashboard.instructor.dashboard.*',
            ],
            [
                'title' => 'profile',
                'icon' => 'fas fa-id-badge',
                'route' => 'dashboard.instructor.profile.index',
                'active' => 'dashboard.instructor.profile.*',
            ],
            [
                'title' => 'categories',
                'icon' => 'fas fa-network-wired',
                'route' => 'dashboard.instructor.category.index',
                'active' => 'dashboard.instructor.category.*',
            ],
            [
                'title' => 'courses',
                'icon' => 'fas fa-book-medical',
                'route' => 'dashboard.instructor.course.index',
                'active' => 'dashboard.instructor.course.*',
            ],
            // [
            //     'title' => 'add lesson',
            //     'icon' => 'far fa-plus-square',
            //     'route' => 'dashboard.instructor.course.index',
            //     'active' => 'dashboard.instructor.course.*',
            // ],
            [
                'title' => 'student',
                'icon' => 'fas fa-user-graduate',
                'route' => 'dashboard.instructor.student.index',
                'active' => 'dashboard.instructor.student.*',
            ]
        ],
        'admin' => [
            [
                'title' => 'dashboard',
                'icon' => 'fas fa-home',
                'route' => 'dashboard.dashboard.index',
                'active' => 'dashboard.dashboard.*',
            ],
            [
                'title' => 'categories',
                'icon' => 'fas fa-network-wired',
                'route' => 'dashboard.category.index',
                'active' => 'dashboard.category.*',
            ],
            [
                'title' => 'instructors',
                'icon' => 'fa fa-users',
                'route' => 'dashboard.instructor.index',
                'active' => 'dashboard.instructor.*',
            ],
            [
                'title' => 'courses',
                'icon' => 'fas fa-book-medical',
                'route' => 'dashboard.course.index',
                'active' => 'dashboard.course.*',
            ],
            [
                'title' => 'student',
                'icon' => 'fas fa-user-graduate',
                'route' => 'dashboard.student.index',
                'active' => 'dashboard.student.*',
            ],
            [
                'title' => 'Testimonials',
                'icon' => 'fas fa-comments',
                'route' => 'dashboard.testimonials.index',
                'active' => 'dashboard.testimonials.*',
            ],
        ],
        'web' => [
            [
                'title' => 'dashboard',
                'icon' => 'fas fa-home',
                'route' => 'student.dashboard.index',
                'active' => 'student.dashboard.*',
            ],
            [
                'title' => 'profile',
                'icon' => 'fas fa-id-badge',
                'route' => 'student.profile.index',
                'active' => 'student.profile.*',
            ],
            [
                'title' => 'coureses',
                'icon' => 'fas fa-book-medical',
                'route' => 'student.courses.index',
                'active' => 'student.courses.*',
            ],
            [
                'title' => 'feedback',
                'icon' => 'far fa-comment',
                'route' => 'student.testimonials.index',
                'active' => 'student.testimonials.*',
            ],
        ]
    ],
];
