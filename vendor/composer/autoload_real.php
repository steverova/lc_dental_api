<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit89541d3f3b7e6a490e55df1ef607b948
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit89541d3f3b7e6a490e55df1ef607b948', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit89541d3f3b7e6a490e55df1ef607b948', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit89541d3f3b7e6a490e55df1ef607b948::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInit89541d3f3b7e6a490e55df1ef607b948::$files;
        $requireFile = static function ($fileIdentifier, $file) {
            if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
                $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

                require $file;
            }
        };
        foreach ($filesToLoad as $fileIdentifier => $file) {
            ($requireFile)($fileIdentifier, $file);
        }

        return $loader;
    }
}
