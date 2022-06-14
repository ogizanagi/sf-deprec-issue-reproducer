# PHP 8 deprecation with Symfony non-debug mode issue reproducer

The project intendly contains a [Foo](./src/Foo.php) class that'll trigger a PHP
8 deprecation:

> Return type of App\Foo::jsonSerialize() should either be compatible with
> JsonSerializable::jsonSerialize(): mixed, or the #[\ReturnTypeWillChange]
> attribute should be used to temporarily suppress the notice

```shell
symfony serve
```

will serve the app on [localhost:8000](http://localhost:8000) with debug
enabled, collecting the deprecations warnings, which are available in the log
panel.

```shell
rm -rf var/cache
APP_DEBUG=0 symfony serve
```

will serve the app without debug mode.  

**Issue**: On 1st call, the deprecations will be output to the response ❌

On Symfony CLI logs, the following can be seen:

```shell
[PHP-FPM    ] [16-Jun-2022 07:59:14 UTC] PHP Deprecated:  Return type of App\Foo::jsonSerialize() should either be compatible with JsonSerializable::jsonSerialize(): mixed, or the #[\ReturnTypeWillChange] attribute should be used to temporarily suppress the notice in /Users/ogi/deprec_issue_reproducer/src/Foo.php on line 7
```

on subsequent calls, the deprecation is unseen from the response ✔️

_(Note: `ini_set('display_errors', 0);` solves this, which should already be disabled on production servers.)_
