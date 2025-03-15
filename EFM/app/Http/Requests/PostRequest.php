<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PostRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required'
        ];
    }
}