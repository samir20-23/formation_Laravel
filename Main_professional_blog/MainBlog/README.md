
- **Policies (Authorization)**
- **Multi-language support**
- **Unit testing**
- **Deployment**
- **CRUD for Articles & Categories**  

I'll guide you **step by step from scratch** with professional best practices. Let's start! 🚀  

---

## **1. Setting Up Laravel Project**  
```bash
composer create-project laravel/laravel blog
cd blog
php artisan serve
```

### **Database Configuration**
Update `.env`:  
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
```
Then, run:
```bash
php artisan migrate
```

---

## **2. Creating Models, Migrations & Factories**  

### **Article & Category Models**
```bash
php artisan make:model Article -mfs
php artisan make:model Category -mfs
```

### **Migration Files**  

#### **Articles Table**
```php
public function up()
{
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

#### **Categories Table**
```php
public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
}
```
Run the migrations:  
```bash
php artisan migrate
```

---

## **3. Defining Model Relationships**  
### **Article.php**
```php
class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
```

### **Category.php**
```php
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
```

---

## **4. Creating Policies (Authorization)**  

### **Generate Policy for Articles**
```bash
php artisan make:policy ArticlePolicy --model=Article
```

### **Define Authorization Rules in `ArticlePolicy.php`**
```php
class ArticlePolicy
{
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
```

### **Register Policy in `AuthServiceProvider.php`**
```php
protected $policies = [
    Article::class => ArticlePolicy::class,
];
```

### **Use Policy in Controller**
```php
public function update(Request $request, Article $article)
{
    $this->authorize('update', $article);
    $article->update($request->all());
    return response()->json($article);
}
```

---

## **5. Multi-Language Support (Localization)**  

### **Setup Language Files**  
```bash
php artisan lang:publish
```

Edit **`resources/lang/en/messages.php`**:  
```php
return [
    'welcome' => 'Welcome to our website',
];
```

Edit **`resources/lang/fr/messages.php`**:  
```php
return [
    'welcome' => 'Bienvenue sur notre site',
];
```

### **Use Translations in Views**
```blade
{{ __('messages.welcome') }}
```

### **Change Language Dynamically**
```php
App::setLocale('fr');
```

---

## **6. Unit Testing (TDD with PHPUnit)**  

### **Create Test for Articles**
```bash
php artisan make:test ArticleTest
```

### **Write Test in `ArticleTest.php`**
```php
public function test_create_article()
{
    $category = Category::factory()->create();
    $response = $this->post('/articles', [
        'title' => 'Test Article',
        'content' => 'This is a test',
        'category_id' => $category->id
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
}
```

Run Tests:
```bash
php artisan test
```

---

## **7. Deployment (Using Laravel Forge + GitHub Actions)**  

### **1. Prepare the Environment**
- Use **Laravel Forge** or **VPS (Ubuntu)**
- Install **PHP, MySQL, Nginx, Composer**

### **2. Configure GitHub Actions for Automatic Deployment**
Create `.github/workflows/deploy.yml`:  
```yaml
name: Deploy Laravel

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout repository
        uses: actions/checkout@v3

      - name: Install dependencies
        run: composer install --no-dev --optimize-autoloader

      - name: Run migrations
        run: php artisan migrate --force

      - name: Restart server
        run: php artisan cache:clear && php artisan config:clear
```

### **3. Configure Server for Laravel**
```bash
sudo chown -R www-data:www-data /var/www/blog
sudo chmod -R 775 /var/www/blog/storage /var/www/blog/bootstrap/cache
```

### **4. Setup Supervisor for Queue Workers**
```bash
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```
Add:
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/blog/artisan queue:work --tries=3
autostart=true
autorestart=true
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/blog/storage/logs/worker.log
```

Restart Supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

---

## **🔥 Next Steps: Advanced Features**
- Implement **Full-text Search** (Laravel Scout + MeiliSearch)
- Add **Livewire or Inertia.js** for dynamic UI
- Use **Docker** for better development & deployment
- Secure APIs with **Laravel Sanctum**
- Implement **Multi-Tenant System** for SaaS applications  

---

### **🚀 Summary**
✅ **Built an Article-Category CRUD**  
✅ **Added Authorization using Policies**  
✅ **Implemented Multi-language support**  
✅ **Wrote Unit Tests**  
✅ **Setup Deployment using GitHub Actions & Supervisor**  
