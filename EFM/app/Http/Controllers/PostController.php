<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
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
        return view('posts.index', ['posts'=>$posts]);
    }
    public function store(PostRequest $request) {
        $this->authorize('create', Post::class);
        $data = $request->only('title','content');
        $post = $this->postService->createPost($data);
        return response()->json($post);
    }
    public function show($id) {
        $post = $this->postService->getPost($id);
        return response()->json($post);
    }
    public function update(PostRequest $request, $id) {
        $post = $this->postService->getPost($id);
        $this->authorize('update', $post);
        $data = $request->only('title','content');
        $post = $this->postService->updatePost($id, $data);
        return response()->json($post);
    }
    public function destroy($id) {
        $post = $this->postService->getPost($id);
        $this->authorize('delete', $post);
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