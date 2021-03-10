<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit33f3fca64ce26425fe6d6592370723a9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit33f3fca64ce26425fe6d6592370723a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit33f3fca64ce26425fe6d6592370723a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit33f3fca64ce26425fe6d6592370723a9::$classMap;

        }, null, ClassLoader::class);
    }
}