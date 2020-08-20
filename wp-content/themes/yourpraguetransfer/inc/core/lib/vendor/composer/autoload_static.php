<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf968db9cb3c66fa2a280581952c8d626
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        'a9b805bf529b5a997093b3cddca2af6f' => __DIR__ . '/..' . '/gopay/payments-sdk-php/factory.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'GoPay\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'GoPay\\' => 
        array (
            0 => __DIR__ . '/..' . '/gopay/payments-sdk-php/src',
        ),
    );

    public static $classMap = array (
        'Fakturoid\\Client' => __DIR__ . '/..' . '/fakturoid/fakturoid-php/lib/Fakturoid/Client.php',
        'Fakturoid\\Exception' => __DIR__ . '/..' . '/fakturoid/fakturoid-php/lib/Fakturoid/Exception.php',
        'Fakturoid\\Request' => __DIR__ . '/..' . '/fakturoid/fakturoid-php/lib/Fakturoid/Request.php',
        'Fakturoid\\Requester' => __DIR__ . '/..' . '/fakturoid/fakturoid-php/lib/Fakturoid/Requester.php',
        'Fakturoid\\Response' => __DIR__ . '/..' . '/fakturoid/fakturoid-php/lib/Fakturoid/Response.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf968db9cb3c66fa2a280581952c8d626::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf968db9cb3c66fa2a280581952c8d626::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf968db9cb3c66fa2a280581952c8d626::$classMap;

        }, null, ClassLoader::class);
    }
}