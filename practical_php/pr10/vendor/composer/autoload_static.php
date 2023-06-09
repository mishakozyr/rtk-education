<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcef647f4a679c11f1f86736254e4991f
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Imagine\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Imagine\\' => 
        array (
            0 => __DIR__ . '/..' . '/imagine/imagine/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcef647f4a679c11f1f86736254e4991f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcef647f4a679c11f1f86736254e4991f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcef647f4a679c11f1f86736254e4991f::$classMap;

        }, null, ClassLoader::class);
    }
}
