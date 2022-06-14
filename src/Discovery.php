<?php

namespace SirMathays\Convenience;

use Closure;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class Discovery
{
    /**
     * Get all of the instantiable classes by searching the given directory.
     *
     * @param string $path
     * @param string|null $basePath
     * @return \Illuminate\Support\Collection
     */
    public static function within(
        string $path,
        string $basePath = null,
        ?Closure $filter = null
    ) {
        $basePath = $basePath ?: base_path();

        $files = (new Finder)->files()->in(
            Str::finish($basePath, '/') . ltrim($path, DIRECTORY_SEPARATOR)
        );

        $classes = collect();

        foreach ($files as $file) {
            try {
                $class = new ReflectionClass(static::classFromFile($file, $basePath));
            } catch (ReflectionException $e) {
                continue;
            }

            if ($filter && !$filter($class)) {
                continue;
            }

            $classes->push($class->getName());
        }

        return $classes;
    }

    /**
     * Get all of the abstract classes by searching the given directory.
     *
     * @param string $path
     * @param string|null $basePath
     * @return \Illuminate\Support\Collection
     */
    public static function abstractsWithin(string $path, string $basePath = null)
    {
        return static::within($path, $basePath, function (ReflectionClass $class) {
            return $class->isAbstract() && !$class->isInterface() && !$class->isTrait();
        });
    }

    /**
     * Get all of the classes by searching the given directory.
     *
     * @param string $path
     * @param string|null $basePath
     * @return \Illuminate\Support\Collection
     */
    public static function classesWithin(string $path, string $basePath = null)
    {
        return static::within($path, $basePath, function (ReflectionClass $class) {
            return $class->isInstantiable();
        });
    }

    /**
     * Get all of the interfaces by searching the given directory.
     *
     * @param string $path
     * @param string|null $basePath
     * @return \Illuminate\Support\Collection
     */
    public static function interfacesWithin(string $path, string $basePath = null)
    {
        return static::within($path, $basePath, function (ReflectionClass $class) {
            return $class->isInterface();
        });
    }

    /**
     * Get all of the traits by searching the given directory.
     *
     * @param string $path
     * @param string|null $basePath
     * @return \Illuminate\Support\Collection
     */
    public static function traitsWithin(string $path, string $basePath = null)
    {
        return static::within($path, $basePath, function (ReflectionClass $class) {
            return $class->isTrait();
        });
    }

    /**
     * Extract the class name from the given file path.
     *
     * @param \SplFileInfo $file
     * @param string $basePath
     * @return string
     */
    protected static function classFromFile(SplFileInfo $file, $basePath)
    {
        $class = trim(Str::replaceFirst($basePath, '', $file->getRealPath()), DIRECTORY_SEPARATOR);

        return str_replace(
            [DIRECTORY_SEPARATOR, ucfirst(basename(app()->path())) . '\\'],
            ['\\', app()->getNamespace()],
            ucfirst(Str::replaceLast('.php', '', $class))
        );
    }
}
