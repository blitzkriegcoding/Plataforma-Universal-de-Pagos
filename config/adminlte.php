<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Plataforma Universal de Pagos para Servipag',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Admin</b> PUP',

    'logo_mini' => '<b>PUP</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'yellow',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => 'fixed',

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MENÚ PRINCIPAL',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'permission'  => 'manage-blog',
        ],
        // [
        //     'text'        => 'Pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        [
            'text'    => 'Mantenedor de empresas',
            'icon'    => 'list',
            'permission'     => 'manage-enterprises',
            'submenu' => [
                [
                    'text' => 'Nueva Empresa',
                    'icon'    => 'chevron-right',
                    'url'  => 'admin/new_enterprise',
                    'permission'  => 'create-enterprise',
                ],
                [
                    'text'    => 'Visualizar Empresas',
                    'icon'    => 'chevron-right',
                    'url'     => 'admin/edit_enterprise',
                    'permission'     => 'edit-enterprise',
                ],

            ],
        ],
        [
            'text'    => 'Mantenedor de Clientes',
            'icon'    => 'tags',
            'permission'     => 'manage-enterprises',
            'submenu' => [
                [
                    'text' => 'Nuevo Cliente',
                    'icon'    => 'chevron-right',
                    'url'  => 'admin/new_client',
                    /*'permission'  => 'create-enterprise',*/
                ],
                [
                    'text'    => 'Visualizar Clientes',
                    'icon'    => 'chevron-right',
                    'url'     => 'admin/report_clients',
                    /*'permission'     => 'edit-enterprise',*/
                ],                

            ],
        ],
        [
            'text'    => 'Gestión Crediticia',
            'icon'    => 'credit-card',
            'submenu' => [
                [
                    'text' => 'Generar nuevo crédito',
                    'icon'    => 'chevron-right',
                    'url'     => 'admin/new_credit',
                ],
                [
                    'text'    => 'Cargas Masivas',
                    'url'     => '#',
                    'icon'    => 'chevron-right',
                    'submenu' => [
                        [
                            'text' => 'Nueva carga masiva',
                            'icon'    => 'chevron-right',
                            'url'  => 'admin/massive_upload_credits',
                        ],
                        [
                            'text'    => "Histórico de cargas",
                            'icon'    => 'chevron-right',
                            'url'     => 'admin/uploads_history_report',
                        ],
                    ],
                ],                
                [
                    'text'    => 'Tasas de Interés',
                    'url'     => '#',
                    'icon'    => 'chevron-right',
                    'submenu' => [
                        [
                            'text' => 'Nueva tasa',
                            'icon'    => 'chevron-right',
                            'url'  => '#',
                            'submenu' => [
                                [
                                    'text'  => 'Diaria',
                                    'url'   => 'admin/new_daily_interest',
                                    'icon'  => 'chevron-right',
                                ],
                                [
                                    'text'  => 'Mensual',
                                    'url'   => 'admin/new_monthly_interest',
                                    'icon'  => 'chevron-right',
                                ], 
                            ]                           
                        ],
                        [
                            'text'    => 'Listado de tasas',
                            'icon'    => 'chevron-right',
                            'url'     => '#',
                        ],
                    ],
                ],  
                               
                // [
                //     'text'    => 'Morosidad',
                //     'url'     => '#',
                //     'submenu' => [
                //         [
                //             'text' => 'Level Two',
                //             'url'  => '#',
                //         ],
                //         [
                //             'text'    => 'Level Two',
                //             'url'     => '#',
                //             'submenu' => [
                //                 [
                //                     'text' => 'Level Three',
                //                     'url'  => '#',
                //                 ],
                //                 [
                //                     'text' => 'Level Three',
                //                     'url'  => '#',
                //                 ],
                //             ],
                //         ],
                //     ],
                // ],

                // [
                //     'text'    => 'Planes de crédito',
                //     'url'     => '#',
                //     'submenu' => [
                //         [
                //             'text' => 'Level Two',
                //             'url'  => '#',
                //         ],
                //         [
                //             'text'    => 'Level Two',
                //             'url'     => '#',
                //             'submenu' => [
                //                 [
                //                     'text' => 'Level Three',
                //                     'url'  => '#',
                //                 ],
                //                 [
                //                     'text' => 'Level Three',
                //                     'url'  => '#',
                //                 ],
                //             ],
                //         ],
                //     ],
                // ],

                [
                    'text'    => 'Bases de Cálculo',
                    'url'     => '#',
                    'icon'    => 'chevron-right',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],                
            ],
        ], 
        [
            'text'    => 'Mantenedor de usuarios',
            'icon'    => 'user',

            'submenu' => [
                [
                    'text' => 'Nuevo usuario',
                    'url'  => '#',
                ],   
                [
                    'text' => 'Listado de usuarios',
                    'url'  => '#',
                ],
                [
                    'text' => 'Registro de accesos',
                    'url'  => '#',
                ], 
                [
                    'text' => 'Misceláneos',
                    'url'  => '#',
                ],                                
            ],
        ],
       
        [
            'text'    => 'Mantenedor de Canales',
            'icon'    => 'edit',
            'submenu' => [
                            // [
                            //     'text' => 'Gestionar canales',
                            //     'url'  => '#',
                            //     'icon'    => 'chevron-right',  
                            // ],
                            [
                                'text'    => 'Nuevo canal',
                                'url'     => 'admin/new_channel',
                                'icon'    => 'chevron-right',  
                            ],
                            [
                                'text'    => 'Asociar canales',
                                'url'     => 'admin/new_enterprise_channel',
                                'icon'    => 'chevron-right',  
                            ],
                            [
                                'text'    => 'Visualizar canales',
                                'url'     => '#',
                                'icon'    => 'chevron-right',  
                            ],
                        ],
        ],         
        'PERFIL DEL USUARIO',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        // JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class, // Comment this line out if you want
        App\MyMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
    ],
];
