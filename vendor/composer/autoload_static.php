<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67f1c493a32c31bc85b82e49dea39884
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sys\\' => 4,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sys\\' => 
        array (
            0 => __DIR__ . '/../..' . '/system/library',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit67f1c493a32c31bc85b82e49dea39884::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit67f1c493a32c31bc85b82e49dea39884::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}