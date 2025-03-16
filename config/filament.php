<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect Filament
    | to any Pusher-compatible websockets server.
    |
    | This will allow your users to receive real-time notifications.
    |
    */

    'broadcasting' => [
        // Configuración de Laravel Echo (opcional)
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to store files. You may use
    | any of the disks defined in the `config/filesystems.php`.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Assets Path
    |--------------------------------------------------------------------------
    */

    'assets_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Path
    |--------------------------------------------------------------------------
    */

    'cache_path' => base_path('bootstrap/cache/filament'),

    /*
    |--------------------------------------------------------------------------
    | Livewire Loading Delay
    |--------------------------------------------------------------------------
    */

    'livewire_loading_delay' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Panels
    |--------------------------------------------------------------------------
    |
    | This is where you define the panels available in your Filament application.
    | By default, you'll have a single panel. You can add more as needed.
    |
    */

    'default_panel' => 'default', // Definimos el panel por defecto

    'panels' => [
        'default' => [
            'id' => 'default',
            'path' => app_path('Filament'),
            'namespace' => 'App\\Filament',
            'resource_directories' => [
                app_path('Filament/Resources'), // Directorio de recursos
            ],
            'pages_directory' => app_path('Filament/Pages'), // Directorio de páginas personalizadas
            'widgets_directory' => app_path('Filament/Widgets'), // Directorio de widgets
            'navigation' => [
                'icon' => 'heroicon-o-home', // Ícono predeterminado en el menú
                'sort' => 0, // Orden predeterminado
            ],
        ],
    ],

];
