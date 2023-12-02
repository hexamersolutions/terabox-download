<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5917e04208dccce743d99bb46926205
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hxsoul\\TeraboxDownload\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hxsoul\\TeraboxDownload\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5917e04208dccce743d99bb46926205::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5917e04208dccce743d99bb46926205::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf5917e04208dccce743d99bb46926205::$classMap;

        }, null, ClassLoader::class);
    }
}