# Side Effect 💥

> **This is what stringly-typed programming is (h/t [@nilsluxton](https://twitter.com/nilsluxton/status/1555204139562549254))**

Side effect is a middleware-ish framework that does NOT support PSR-15.

Everything is marshalling a string, basically. So, everything is `__toString()`.

## Features ✨

 * 💻 Dispatch controllers (extend `\Asgrim\SideEffect\Features\AbstractController` for ease of use!)
 * 🧅 Dispatch middlewares (anything that implements `\Asgrim\SideEffect\Dispatchable` can be used!)
 * 💾 Perform database queries using `\Asgrim\SideEffect\Features\PerformDatabaseQuery`
 * 🤫 Handle errors effectively with `\Asgrim\SideEffect\Features\ShutTheHellUpDecorator`

## Basic Usage

```php
echo (new Framework(
    $serverRequest, // You could use `guzzlehttp/psr7` to make this
    [
        // Add loads more middlewares here to do spooky things! 💕
        new class extends AbstractController {
            public function __toString() : string
            {
                return 'Hello, world!';
            }
        },
    ]
));
```

## Demo Script 🔥

The `demo.php` script shows an example application using the framework. You can base your enterprise level application
on this easy example.

You can run the `demo.php` script to see it in action like this:

```bash
php -S localhost:8000 demo.php
```

Then visit: http://localhost:8000/?who=james
