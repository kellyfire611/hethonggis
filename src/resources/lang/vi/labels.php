<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'Tất cả',
        'yes'     => 'Đồng ý',
        'no'      => 'Không',
        'copyright' => 'Bản quyền',
        'custom'  => 'Tùy chỉnh',
        'actions' => 'Hành động',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Lưu',
            'update' => 'Cập nhật',
        ],
        'hide'              => 'Ẩn',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new'        => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more'              => 'Nâng cao',
        'none'              => 'None',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Tạo mới Vai trò',
                'edit'       => 'Sửa Vai trò',
                'management' => 'Quản lý Vai trò',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',
                'user_actions'        => 'User Actions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions'    => 'Permissions',
                    'abilities'      => 'Abilities',
                    'roles'          => 'Roles',
                    'social'         => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                            'timezone'     => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Đăng nhập',
            'login_button'       => 'Đăng nhập',
            'login_with'         => 'Đăng nhập với :social_media',
            'register_box_title' => 'Đăng ký',
            'register_button'    => 'Đăng ký',
            'remember_me'        => 'Ghi nhớ đăng nhập',
        ],

        'contact' => [
            'box_title' => 'Liên hệ với Chúng tôi',
            'button' => 'Gởi tin nhắn',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Quên mật khẩu?',
            'reset_password_box_title'        => 'Khởi tạo mật khẩu mới',
            'reset_password_button'           => 'Khởi tạo mật khẩu mới',
            'update_password_button'           => 'Cập nhật Mật khẩu',
            'send_password_reset_link_button' => 'Gởi Mật khẩu mới',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Đổi mật khẩu',
            ],

            'profile' => [
                'avatar'             => 'Ảnh đại diện',
                'created_at'         => 'Ngày tạo',
                'edit_information'   => 'Hiệu chỉnh Thông tin',
                'email'              => 'E-mail',
                'last_updated'       => 'Ngày cập nhật',
                'name'               => 'Tên',
                'first_name'         => 'Tên',
                'last_name'          => 'Họ',
                'update_information' => 'Cập nhật Thông tin',
            ],
        ],

    ],
];
