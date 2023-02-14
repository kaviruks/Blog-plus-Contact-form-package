<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit356141a6f850f2b0ee183f563976a9e9
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kavinda\\Contact\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kavinda\\Contact\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit356141a6f850f2b0ee183f563976a9e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit356141a6f850f2b0ee183f563976a9e9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit356141a6f850f2b0ee183f563976a9e9::$classMap;

        }, null, ClassLoader::class);
    }
}