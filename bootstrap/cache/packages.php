<?php return array(
    'facade/ignition' =>
    array(
        'providers' =>
        array(
            0 => 'Facade\\Ignition\\IgnitionServiceProvider',
        ),
        'aliases' =>
        array(
            'Flare' => 'Facade\\Ignition\\Facades\\Flare',
        ),
    ),
    'fideloper/proxy' =>
    array(
        'providers' =>
        array(
            0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
        ),
    ),
    'fruitcake/laravel-cors' =>
    array(
        'providers' =>
        array(
            0 => 'Fruitcake\\Cors\\CorsServiceProvider',
        ),
    ),
    'laravel/tinker' =>
    array(
        'providers' =>
        array(
            0 => 'Laravel\\Tinker\\TinkerServiceProvider',
        ),
    ),
    'nesbot/carbon' =>
    array(
        'providers' =>
        array(
            0 => 'Carbon\\Laravel\\ServiceProvider',
        ),
    ),
    'nunomaduro/collision' =>
    array(
        'providers' =>
        array(
            0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
        ),
    ),
    'owen-oj/laravel-getid3' =>
    array(
        'providers' =>
        array(
            0 => 'Owenoj\\LaravelGetId3\\GetId3ServiceProvider',
        ),
    ),
    'pbmedia/laravel-ffmpeg' =>
    array(
        'providers' =>
        array(
            0 => 'ProtoneMedia\\LaravelFFMpeg\\Support\\ServiceProvider',
        ),
        'aliases' =>
        array(
            'FFMpeg' => 'ProtoneMedia\\LaravelFFMpeg\\Support\\FFMpeg',
        ),
    ),
    'santigarcor/laratrust' =>
    array(
        'providers' =>
        array(
            0 => 'Laratrust\\LaratrustServiceProvider',
        ),
        'aliases' =>
        array(
            'Laratrust' => 'Laratrust\\LaratrustFacade',
        ),
    ),
    'simplesoftwareio/simple-qrcode' =>
    array(
        'providers' =>
        array(
            0 => 'SimpleSoftwareIO\\QrCode\\QrCodeServiceProvider',
        ),
        'aliases' =>
        array(
            'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
        ),
    ),
);
