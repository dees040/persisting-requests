# Persisting Requests

This package will let you create persisting requests in a breeze. It will call a persisting method on your request via the Laravel Container, meaning you can use dependency injection. The package is inspired by [this Laracasts video](https://laracasts.com/series/whip-monstrous-code-into-shape/episodes/1). The package can help cleaning up your controller.

## Installation

Install the latest version with composer.

```
composer require dees040/persisting-request
```

After installing the packages and the service provider to the `providers` array in `app/config.php`.
 
```php
dees040\PersistingRequests\ServiceProvider::class,

```

## Usage

You can now run the `make:persist` command.

```
php artisan make:persist FooBarRequest
```

In your controller you can now add the fresh created request to the method. Laravel will automatically inject in via dependency injection.

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\FooBarRequest;

class ActivationController extends Controller
{
    public function activate(FooBarRequest $request)
    {
        $request->persist();

        return view('home');
    }
}
```

Now in your request you can add dependencies to the `persisting` method.

```php
<?php

namespace App\Http\Requests;

use dees040\PersistingRequests\PersistingRequest;

class FooBarRequest extends PersistingRequest
{
    /**
     * Persist the request.
     *
     * @return void
     */
    public function persisting(ActivationManager $manager)
    {
        $manager->activate($this->user());
    }
}
```