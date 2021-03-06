<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8aed27964c889f1235f4d852b51961bb
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JeroenDesloovere\\VCard\\' => 23,
        ),
        'B' => 
        array (
            'Behat\\Transliterator\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JeroenDesloovere\\VCard\\' => 
        array (
            0 => __DIR__ . '/..' . '/jeroendesloovere/vcard/src',
        ),
        'Behat\\Transliterator\\' => 
        array (
            0 => __DIR__ . '/..' . '/behat/transliterator/src/Behat/Transliterator',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8aed27964c889f1235f4d852b51961bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8aed27964c889f1235f4d852b51961bb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
