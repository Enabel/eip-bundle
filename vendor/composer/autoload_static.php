<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2f520aefc6d1081d4f89ae5975a454c8
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Enabel\\Eip\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Enabel\\Eip\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2f520aefc6d1081d4f89ae5975a454c8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2f520aefc6d1081d4f89ae5975a454c8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2f520aefc6d1081d4f89ae5975a454c8::$classMap;

        }, null, ClassLoader::class);
    }
}
