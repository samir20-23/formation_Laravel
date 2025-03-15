```
composer create-project --prefer-dist laravel/laravel efm_backend
cd efm_backend
php artisan make:model Post -m
php artisan make:controller PostController --resource
php artisan make:seeder PostSeeder
mkdir -p app/Repositories
echo "" > app/Repositories/PostRepositoryInterface.php
echo "" > app/Repositories/PostRepository.php
mkdir -p app/Services
echo "" > app/Services/PostService.php
mkdir -p app/Modules/System
echo "" > app/Modules/System/SystemModule.php
php artisan make:provider ModuleServiceProvider
```

```
File: app/Models/Post.php
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model {
    use HasFactory;
    protected $fillable = ['title','content'];
}
```

```
File: database/migrations/2025_03_15_000000_create_posts_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('posts');
    }
};
```

```
File: database/seeders/PostSeeder.php
<?php
namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;
class PostSeeder extends Seeder {
    public function run() {
        Post::create(['title'=>'🔥 First Post','content'=>'🚩 Content of first post']);
        Post::create(['title'=>'💻 Second Post','content'=>'❤ Content of second post']);
    }
}
```

```
File: app/Repositories/PostRepositoryInterface.php
<?php
namespace App\Repositories;
use App\Models\Post;
interface PostRepositoryInterface {
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
```

```
File: app/Repositories/PostRepository.php
<?php
namespace App\Repositories;
use App\Models\Post;
class PostRepository implements PostRepositoryInterface {
    public function getAll() {
        return Post::all();
    }
    public function getById($id) {
        return Post::find($id);
    }
    public function create(array $data) {
        return Post::create($data);
    }
    public function update($id, array $data) {
        $post = Post::find($id);
        $post->update($data);
        return $post;
    }
    public function delete($id) {
        return Post::destroy($id);
    }
}
```

```
File: app/Services/PostService.php
<?php
namespace App\Services;
use App\Repositories\PostRepositoryInterface;
class PostService {
    protected $postRepository;
    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }
    public function getAllPosts() {
        return $this->postRepository->getAll();
    }
    public function getPost($id) {
        return $this->postRepository->getById($id);
    }
    public function createPost($data) {
        return $this->postRepository->create($data);
    }
    public function updatePost($id, $data) {
        return $this->postRepository->update($id, $data);
    }
    public function deletePost($id) {
        return $this->postRepository->delete($id);
    }
}
```

```
File: app/Modules/System/SystemModule.php
<?php
namespace App\Modules\System;
class SystemModule {
    public function init() {
        return true;
    }
}
```

```
File: app/Http/Controllers/PostController.php
<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller {
    protected $postService;
    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }
    public function index(Request $request) {
        $search = $request->get('search');
        $posts = $this->postService->getAllPosts();
        if($search) {
            $posts = $posts->filter(function($post) use ($search) {
                return stripos($post->title, $search) !== false;
            });
        }
        if($request->ajax()) {
            return response()->json($posts);
        }
        return view('posts.index', compact('posts'));
    }
    public function store(Request $request) {
        $data = $request->only('title','content');
        $post = $this->postService->createPost($data);
        return response()->json($post);
    }
    public function show($id) {
        $post = $this->postService->getPost($id);
        return response()->json($post);
    }
    public function update(Request $request, $id) {
        $data = $request->only('title','content');
        $post = $this->postService->updatePost($id, $data);
        return response()->json($post);
    }
    public function destroy($id) {
        $this->postService->deletePost($id);
        return response()->json(['success'=>true]);
    }
    public function export() {
        $posts = $this->postService->getAllPosts();
        $csv = "id,title,content\r\n";
        foreach($posts as $post) {
            $csv .= $post->id.",".$post->title.",".$post->content."\r\n";
        }
        Storage::disk('local')->put('posts.csv', $csv);
        return response()->download(storage_path('app/posts.csv'));
    }
    public function import(Request $request) {
        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file));
        foreach($data as $row) {
            if(isset($row[1]) && isset($row[2])) {
                $this->postService->createPost(['title'=>$row[1],'content'=>$row[2]]);
            }
        }
        return response()->json(['success'=>true]);
    }
}
```

```
File: routes/web.php
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::get('/', function() {
    return view('posts.index');
});
Route::resource('posts', PostController::class);
Route::get('posts-export', [PostController::class, 'export'])->name('posts.export');
Route::post('posts-import', [PostController::class, 'import'])->name('posts.import');
```

```
File: app/Providers/ModuleServiceProvider.php
<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;
class ModuleServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
    public function boot() {}
}
```

```
File: resources/views/layout/app.blade.php
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<title>🔥🚩 EFM Backend 💻❤🎉⚠⚡</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
@yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
```

```
File: resources/views/posts/index.blade.php
@extends('layout.app')
@section('content')
<div class="mt-5">
<input type="text" id="search" placeholder="🔥🚩 Search" class="form-control mb-3">
<button id="load" class="btn btn-primary mb-3">💻❤ Load Posts</button>
<div id="posts"></div>
<form id="postForm">
<input type="text" name="title" placeholder="🎉 Title" class="form-control mb-2">
<textarea name="content" placeholder="⚠ Content" class="form-control mb-2"></textarea>
<button type="submit" class="btn btn-success">⚡ Save</button>
</form>
<form id="importForm" enctype="multipart/form-data" class="mt-3">
<input type="file" name="file" class="form-control mb-2">
<button type="submit" class="btn btn-info">🚩 Import</button>
</form>
<a href="{{ route('posts.export') }}" class="btn btn-warning mt-2">💻 Export</a>
</div>
@endsection
```

```
File: public/js/app.js
$(document).ready(function(){
function loadPosts(query){
$.ajax({url:"/posts",data:{search:query},success:function(data){
var html="";
data.forEach(function(post){
html+="<div><h3>"+post.title+"</h3><p>"+post.content+"</p></div>";
});
$("#posts").html(html);
}});
}
$("#load").click(function(){
loadPosts($("#search").val());
});
$("#postForm").submit(function(e){
e.preventDefault();
$.ajax({url:"/posts",method:"POST",data:$(this).serialize(),success:function(data){
loadPosts("");
$("#postForm")[0].reset();
}});
});
$("#importForm").submit(function(e){
e.preventDefault();
var formData = new FormData(this);
$.ajax({url:"/posts-import",method:"POST",data:formData,processData:false,contentType:false,success:function(data){
loadPosts("");
}});
});
});
```

```
File: resources/lang/en/messages.php
<?php
return [
'title'=>'Title',
'content'=>'Content'
];
```

```
File: resources/lang/es/messages.php
<?php
return [
'title'=>'Título',
'content'=>'Contenido'
];
```