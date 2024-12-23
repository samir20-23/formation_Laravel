It sounds like the issue may be related to middleware configuration or route loading when using `$this->loadRoutesFrom($routeFile);`. When loading routes dynamically like this, sometimes the `auth` middleware may not apply as expected, leading to issues such as all routes redirecting to the `home` route.

Here are some troubleshooting steps to address this:

### 1. Ensure Middleware is Registered
Verify that the `auth` middleware is registered correctly in `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    // Other middleware
    'auth' => \App\Http\Middleware\Authenticate::class,
];
```

### 2. Check Your `auth` Middleware Configuration
In the `Authenticate` middleware (located at `app/Http/Middleware/Authenticate.php`), ensure the redirection logic is correctly set up in the `redirectTo` method:

```php
protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('login');
    }
}
```

### 3. Apply `auth` Middleware to Specific Routes or Groups
Ensure that `auth` middleware is applied only to specific routes or route groups that require authentication. For instance, you might have:

In `$routeFile`:

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Other authenticated routes
});
```

Ensure there’s no conflicting `Route::redirect('/', 'home')` or other automatic redirects.

### 4. Check for Duplicate Middleware
When loading routes using `$this->loadRoutesFrom()`, check that the `auth` middleware is not applied twice unintentionally (e.g., in both the loaded route file and a route group). This can sometimes lead to unexpected behavior like redirections.

### 5. Debug Middleware Flow
If the issue persists, try logging the request in the `Authenticate` middleware to see if the middleware conditions are triggering unexpectedly:

```php
Log::info('Auth Middleware - URL: ' . $request->url());
```

### 6. Confirm Route Loading Order
Since routes work correctly in `web.php`, it’s worth confirming that `$routeFile` is loaded after `web.php`. If `$this->loadRoutesFrom($routeFile);` is loading routes before `web.php`, they might be affected by unintended route definitions.

### 7. Clear Route Cache
Laravel caches routes, so if you’ve made changes to the route configuration, clear the cache:

```bash
php artisan route:cache
```

After verifying these points, the `auth` middleware should apply correctly to the specified routes without redirecting all pages to `home`.