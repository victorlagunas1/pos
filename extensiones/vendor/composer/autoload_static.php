<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9998fb560945f5c948288332e7e4f535
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
            1 => __DIR__ . '/..' . '/mike42/gfx-php/src/Mike42',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9998fb560945f5c948288332e7e4f535::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9998fb560945f5c948288332e7e4f535::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
