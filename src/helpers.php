<?php

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

if (!function_exists('class_uses_trait')) {
    /**
     * Return boolean value whether the given class uses given trait.
     *
     * @param mixed $class An object (class instance) or a string (class name).
     * @param string $trait Class name of the trait.
     * @param bool $recursive Should trait's be found recursively.
     * @return bool
     */
    function class_uses_trait($class, $trait, bool $recursive = true): bool
    {
        $func = $recursive ? 'class_uses_recursive' : 'class_uses';
        return isset($func($class)[$trait]);
    }
}

if (!function_exists('class_implements_interface')) {
    /**
     * Return boolean value whether the given class implements given interface.
     *
     * @param mixed $class An object (class instance) or a string (class name).
     * @param string $interface Class name of the interface.
     * @return bool
     */
    function class_implements_interface($class, $interface): bool
    {
        return isset(class_implements($class)[$interface]);
    }
}

if (!function_exists('class_extends')) {
    /**
     * Return boolean value whether the given class extends given parent class.
     *
     * @param mixed $class An object (class instance) or a string (class name).
     * @param string $interface Class name of the parent class.
     * @return bool
     */
    function class_extends($class, $parent): bool
    {
        return isset(class_parents($class)[$parent]);
    }
}

if (!function_exists('set_type')) {
    /**
     * Alias for 'settype' which allows non-variables as arguments.
     *
     * @param mixed $value
     * @param string $type
     * @return void
     */
    function set_type($value, $type)
    {
        settype($value, $type);
        return $value;
    }
}

if (!function_exists('trim_spaces')) {
    /**
     * Trim spaces from string.
     *
     * @param string $string
     * @return string
     */
    function trim_spaces(string $string): string
    {
        return trim(preg_replace('/\s\s+/', ' ', $string));
    }
}

if (!function_exists('not_null')) {
    /**
     * !is_null
     *
     * @param mixed $var
     * @return bool
     */
    function not_null($var): bool
    {
        return !is_null($var);
    }
}

if (!function_exists('get_bool')) {
    /**
     * Get boolean value from given value. Accepts string true/false.
     *
     * @param mixed $value
     * @return bool
     */
    function get_bool($value): bool
    {
        switch ($value) {
            case 'true': return true;
            case 'false': return false;
            default: return set_type($value, 'boolean');
        }
    }
}

if (!function_exists('class_namespace')) {
    /**
     * Get namespace of given class.
     *
     * @param string $className
     * @return string
     */
    function class_namespace(string $className): string
    {
        return (string) Str::of($className)->before('\\' . class_basename($className));
    }
}

if (!function_exists('___')) {
    /**
     * Translate given messages and glue them together.
     * @link https://gitlab.com/snippets/1993843
     *
     * @param array $keys
     * @param array $replace
     * @param string|null $locale
     * @param string $glue
     * @return string
     */
    function ___(array $keys, array $replace = [], string $locale = null, string $glue = ' '): string
    {
        foreach ($keys as &$key) $key = __($key, [], $locale);

        return __(implode($glue, $keys), $replace);
    }
}