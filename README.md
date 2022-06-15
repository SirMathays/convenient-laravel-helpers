<p align="center">
    <img src="https://matti.suoraniemi.com/storage/forur2.png" width="400">
</p>

<p align="center">
    <a href="https://packagist.org/packages/sirmathays/convenient-laravel-helpers">
        <img src="https://img.shields.io/packagist/dt/sirmathays/convenient-laravel-helpers" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/sirmathays/convenient-laravel-helpers">
        <img src="https://img.shields.io/packagist/v/sirmathays/convenient-laravel-helpers" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/sirmathays/convenient-laravel-helpers">
        <img src="https://img.shields.io/packagist/l/sirmathays/convenient-laravel-helpers" alt="License">
    </a>
</p>

# Convenient Laravel Helpers

This package provides some additional, convenient helpers for you to use with your Laravel project.

## Installation

Install the package with Composer:

    composer require sirmathays/convenient-laravel-helpers


## Features

### Helpers

- `class_uses_trait($class, $trait, bool $recursive = true): bool`
  - Return boolean value whether the given class uses given trait.
- `array_depth(array $array)`
  - Return integer describing the max depth of the given array.
- `class_implements_interface($class, $interface): bool`
  - Return boolean value whether the given class implements given interface.
- `class_extends($class, $parent): bool`
  - Return boolean value whether the given class extends given parent class.
- `set_type($value, $type)`
  - Alias for 'settype' which allows non-variables as arguments.
- `trim_spaces(string $string): string`
  - Trim spaces from string.
- `not_null($var): bool`
  - !is_null
- `get_bool($value): bool`
  - Get boolean value from given value. Accepts string true/false.
- `class_namespace(string $className): string`
  - Get namespace of given class.
- `___(array $keys, array $replace = [], array $numbers = [], string $locale = null, string $glue = ' '): string`
  - Translate given messages and glue them together.

### Discovery class

This is pretty much copied from `Illuminate\Foundation\Events\DiscoverEvents` from, just made more
generic.

**Examples**

```php
use SirMathays\Convenience\Discovery;

$all = Discovery::within('app\Models');
// ["App\Models\User", "App\Models\BlogPost", "App\Models\Concerns\Taggable", "App\Models\Contracts\BlogWriter"]

$classes = Discovery::classesWithin('app\Models');
// ["App\Models\User", "App\Models\BlogPost"]

$traits = Discovery::traitsWithin('app\Models');
// ["App\Models\Concerns\Taggable"]

$interfaces = Discovery::interfacesWithin('app\Models');
// ["App\Models\Contracts\BlogWriter"]
```

## License

Convenient Laravel Helpers is open-sourced software licensed under the [MIT license](LICENSE.md).
