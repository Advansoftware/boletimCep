<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67345785f4d6b8cce692d1b1613c7061
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpConsole' => 
            array (
                0 => __DIR__ . '/..' . '/php-console/php-console/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit67345785f4d6b8cce692d1b1613c7061::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
