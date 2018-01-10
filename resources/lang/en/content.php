<?php

return [
    'empty' => 'No data to display',

    'page' => [
        'title' => 'Empty title',
        'description' => 'Page description',
    ],

    'profile' => [
        'title' => 'Profile',
        'description' => 'Data user',
    ],

    'vk_bots' => [
        'title' => 'VK Chatbots',
        'description' => 'Manage chatbots VK',
        'create' => [
            'title'      => 'Add chatbot VK',
            'breadcrumb' => 'Create',
        ],
        'edit' => [
            'title'      => 'Edit chatbot VK',
            'breadcrumb' => 'Edit',
        ],
        'test' => [
            'title'      => 'Test chatbot VK',
            'breadcrumb' => 'Test',
            'table' => [
                'title' => 'List commands',
            ],
        ],
        'trash' => [
            'title'      => 'Trash chatbots',
            'breadcrumb' => 'Trash VK',
        ],
    ],

    'vk_commands' => [
        'title'       => 'Commands',
        'create' => [
            'title'      => 'Create command',
            'breadcrumb' => 'Create',
        ],
        'edit' => [
            'title'      => 'Edit command',
            'breadcrumb' => 'Edit',
        ],
    ],

    'users' => [
        'title' => [
            'all'    => 'All users',
            'new'    => 'New users',
            'active' => 'Active users',
            'blocked'=> 'Blocked users',
            'admin'  => 'Administrators',
        ],
        'description' => 'Search and manage users',
        'links' => [
            'all'    => 'All',
            'new'    => 'New',
            'active' => 'Active',
            'blocked'=> 'Blocked',
            'admin'  => 'Admin',
        ],
        'search' => [
            'placeholder' => 'Search by name and email',
            'button' => 'Search',
        ],
        'table' => [
            'title' => 'User list',
        ],
    ],

    'table' => [
        'head' => [
            'id'         => '#',
            'logo'       => 'Logo',
            'name_email' => 'Name/Email',
            'name'       => 'Name',
            'description'=> 'Description',
            'command'    => 'Command',
            'commands'   => 'Commands',
            'status'     => 'Status',
            'password'   => 'Password',
            'dates'      => 'Dates',
            'action'     => 'Actions',
            'type'       => 'Type',
        ],
    ],
];