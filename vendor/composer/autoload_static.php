<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitec168e8f1f366464b4994f105df2a13f
{
    public static $files = array (
        'ea2cc3fbccdc2f9e775752720cc28296' => __DIR__ . '/../..' . '/common/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\bladeone\\' => 15,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\bladeone\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/bladeone/lib',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitec168e8f1f366464b4994f105df2a13f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitec168e8f1f366464b4994f105df2a13f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitec168e8f1f366464b4994f105df2a13f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitec168e8f1f366464b4994f105df2a13f::$classMap;

        }, null, ClassLoader::class);
    }
}
