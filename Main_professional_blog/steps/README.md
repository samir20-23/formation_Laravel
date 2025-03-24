```markdown
# README

## Multi-Language

### resources/lang/en/messages.php
```php
<?php
return [
    'welcome' => 'Welcome to our application',
    'login'   => 'Please log in',
    'logout'  => 'Log out',
];
```

### resources/lang/fr/messages.php
```php
<?php
return [
    'welcome' => 'Bienvenue dans notre application',
    'login'   => 'Veuillez vous connecter',
    'logout'  => 'Se déconnecter',
];
```

### app/Providers/AppServiceProvider.php
```php
<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot()
    {
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
    }
}
```

### routes/web.php (Language Switch)
```php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
});
```

## Policy

### Create Policy (Command)
```bash
php artisan make:policy PostPolicy --model=Post
```

### app/Policies/PostPolicy.php
```php
<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Post;
class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
```

### app/Providers/AuthServiceProvider.php
```php
<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Policies\PostPolicy;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}
```

## Request System

### Create Request (Command)
```bash
php artisan make:request StorePostRequest
```

### app/Http/Requests/StorePostRequest.php
```php
<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body'  => 'required',
        ];
    }
}
```

### app/Http/Controllers/PostController.php (Store)
```php
<?php
namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('posts.index');
    }
}
```

## Modular Import/Export

### Install Package (Command)
```bash
composer require maatwebsite/excel
```

### Create Export (Command)
```bash
php artisan make:export PostsExport --model=Post
```

### app/Exports/PostsExport.php
```php
<?php
namespace App\Exports;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
class PostsExport implements FromCollection
{
    public function collection()
    {
        return Post::all();
    }
}
```

### Create Import (Command)
```bash
php artisan make:import PostsImport --model=Post
```

### app/Imports/PostsImport.php
```php
<?php
namespace App\Imports;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
class PostsImport implements ToModel
{
    public function model(array $row)
    {
        return new Post([
            'title' => $row[0],
            'body'  => $row[1],
        ]);
    }
}
```

### app/Http/Controllers/PostController.php (Import/Export)
```php
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
class PostController extends Controller
{
    public function export()
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    public function import()
    {
        Excel::import(new PostsImport, request()->file('file'));
        return redirect()->route('posts.index');
    }
}
```