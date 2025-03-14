You should replace `Request` with a custom `PostRequest` class for better validation and maintainability. Here’s how to do it:

### Step 1: Create a Request Class  
Run this command in your terminal:  
```bash
php artisan make:request PostRequest
```

### Step 2: Define Validation Rules  
Open `app/Http/Requests/PostRequest.php` and update it:  
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change to policy if needed
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id'
        ];
    }
}
```

### Step 3: Use `PostRequest` in `PostController`
Update your `store` and `update` methods in `PostController.php`:
```php
use App\Http\Requests\PostRequest;

public function store(PostRequest $request)
{
    $this->authorize('create', Post::class);
    
    $post = Post::create($request->validated());
    $post->tags()->attach($request->tags);

    return redirect()->route('posts.index');
}

public function update(PostRequest $request, Post $post)
{
    $this->authorize('update', $post);
    
    $post->update($request->validated());
    $post->tags()->sync($request->tags);

    return redirect()->route('posts.index');
}     