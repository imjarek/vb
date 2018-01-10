<?php

return [
    'label' => [
        'name'         => 'Name',
        'description'  => 'Description',
        'first_name'   => 'Name',
        'surname'      => 'Surname',
        'email'        => 'Email',
        'remember'     => 'remember me',
        'password'     => 'Password',
        'password_old' => 'Current password',
        'password_new' => 'New password',
        'password_confirmation' => 'Repeat Password',
        'enable'       => 'Enable',
        'command'      => 'Command',
        'bw_command'   => 'Bonusway command',
        'message'      => 'Message',
        'message_error'=> 'Message for error',
        'vk'           => [
            'id_group'     => 'Id group',
            'vk_key'       => 'Access key',
            'secret_key'   => 'Secret key',
            'response_api' => 'Server response',
            'widget'       => 'Script widget',
        ],
    ],

    'button' => [
        'ok'             => 'Ok',
        'save'           => 'Save',
        'update'         => 'Update',
        'edit'           => 'Edit',
        'test'           => 'Testing',
        'cancel'         => 'Cancel',
        'user_command'   => 'User command',
        'sys_command'    => 'System command',
        'bw_command'     => 'Bonusway command',
        'commands'       => 'Commands',
        'login'          => 'Login',
        'register'       => 'Register',
        'reset_password' => 'Reset password',
        'chatbot'        => 'ChatBot',
        'remove'         => 'Remove',
        'restore'        => 'Restore',
        'upload_logo'    => [
            'small' => 'Upload',
            'long'  => 'Upload logo',
        ],
        'users' => [
            'set_admin'   => 'Set role Admin',
            'set_user'    => 'Set role User',
            'set_active'  => 'Activate',
            'set_blocked' => 'Block',
        ],
    ],

    'login' => [
        'title' => 'Login',
        'description' => 'Please enter your credentials to login.'
    ],
    'register' => [
        'title' => 'Register',
        'description' => 'Please enter your data to register.'
    ],
    'email_password' => [
        'title' => 'Password Reset',
        'description' => 'Please fill the form to recover your password',
        'text' => 'Fill with your mail to receive instructions on how to reset your password.'
    ],
    'reset_password' => [

    ],
    'profile' => [
        'data'     => ['title' => 'Data user'],
        'logo'     => ['title' => 'Logo'],
        'password' => ['title' => 'Change password'],
    ],
    'commands' => [
        'description' => [
            'user_command' => 'format',
            'sys_command'  => 'select command in list',
            'bw_command'   => 'select command in list, <code>-response-</code> - the response from the bonusway',
        ]
    ],
];