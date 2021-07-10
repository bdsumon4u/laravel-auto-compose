# Laravel Auto Compose

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hotash/laravel-auto-compose.svg?style=flat-square)](https://packagist.org/packages/hotash/laravel-auto-compose)
[![Total Downloads](https://img.shields.io/packagist/dt/hotash/laravel-auto-compose.svg?style=flat-square)](https://packagist.org/packages/hotash/laravel-auto-compose)

A PHP Package To Automatically Compose Route Parameters To Appropriate View In Laravel.

## Installation

You can install the package via composer:

```bash
composer require hotash/laravel-auto-compose
```

## Usage

Nothing to do, just use your route parameters in your views. Don't need to pass the parameters from controller to view unless you modify the parameters in the controller.

```php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Don't need to pass $product to the view.
        return view('products.show');
    }
}
```

All route parameters will be automatically passed to the view by the `laravel-auto-compose` Package.

## Details

If you modify a route parameter but don't pass it to the view from the controller, you'll lose the modification.

```php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('categories')
            ->withTrashed()
            ->findOrFail($id);

        // Updating $id variable.
        $id = 'laravel-auto-compose';

        return view('products.show');
    }
}
```

In the example above, we haven't passed `$product` to our view. So, it wil not be available in the view.
Now, what about `$id`? Well, the change of `$id` variable in the controller will not affect the `$id` variable in the view.  
*In order to have the modification in our view, we must pass the `$id` variable from the controller to our view.*

#### Another Nice Example

```php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = $product->load('categories');
        return view('products.show');
    }
}
```

We've loaded a relationship and updated `$product` variable.  
#### *Is the relationship loaded on view?*
#### Yes, it is. *But why?*
#### You're an Artisan, I'm leaving it upto you.

## Request
> **Please consider giving a star.**

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email bdsumon4u@gmail.com instead of using the issue tracker.

## Credits

- [Sumon Ahmed](https://github.com/bdsumon4u)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
