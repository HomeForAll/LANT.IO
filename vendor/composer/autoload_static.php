<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfb7b422eed57f5af675a7889d3e5600
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Foolz\\SphinxQL\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Foolz\\SphinxQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/foolz/sphinxql-query-builder/src',
        ),
    );

    public static $classMap = array (
        'SphinxClient' => __DIR__ . '/..' . '/neutron/sphinxsearch-api/sphinxapi.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfb7b422eed57f5af675a7889d3e5600::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfb7b422eed57f5af675a7889d3e5600::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcfb7b422eed57f5af675a7889d3e5600::$classMap;

        }, null, ClassLoader::class);
    }
}