sminnee/callbacklist
====================

This micropackage provides a simple class for managing a list of callbacks.

## Usage

```
> composer require sminnee/callbacklist
```

```php
use Sminnee\CallbackList\CallbackList;

$list = new CallbackList;
$list->add(function() { "this will get called"; });
$list->add(function() { "so will this"; });
$list->call();
```

Arguments can be passed:

```php
$list->add(function($greeting) { "$greeting, world!"; });
$list->call("Hello");
```

Existing callbacks can be manipulated:

```php
// Clear the list
$list->clear();

// Or add a callback with a name
$list->add(function($greeting) { "$greeting, world!"; }, 'greeter');

// And then remove by that name
$list->remove('greeter');
```

And you can inspect the content of the list:

```php
// Return a single named callback
$list->get('greeter');

// Return everything as an array
$list->getAll();
```
