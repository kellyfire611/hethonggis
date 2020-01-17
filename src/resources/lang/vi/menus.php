<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Truy cập',

            'roles' => [
                'all'        => 'Tất cả Vai trò',
                'create'     => 'Tạo mới Vai trò',
                'edit'       => 'Sửa Vai trò',
                'management' => 'Quản lý Vai Trò',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'Tất cả Người dùng',
                'change-password' => 'Thay đổi Mật khẩu',
                'create'          => 'Tạo mới Người dùng',
                'deactivated'     => 'Deactivated Users',
                'deleted'         => 'Xóa Người dùng',
                'edit'            => 'Sửa Người dùng',
                'main'            => 'Users',
                'view'            => 'Xem Người dùng',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Nhật ký Hệ thống',
            'dashboard' => 'Bảng thông tin',
            'logs'      => 'Nhật ký',
        ],

        'sidebar' => [
            'dashboard' => 'Bảng thông tin',
            'general'   => 'Chung',
            'history'   => 'Lịch sử',
            'system'    => 'Hệ thống',
        ],
    ],

    'language-picker' => [
        'language' => 'Ngôn ngữ',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fa'    => 'Persian',
            'fr'    => 'French',
            'he'    => 'Hebrew',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'no'    => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
            'uk'    => 'Ukrainian',
            'vi'    => 'Tiếng Việt',
        ],
    ],
];
