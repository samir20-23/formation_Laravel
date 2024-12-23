<?php
namespace Modules\PkgProjets\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|max:40',
            'description' => 'nullable|max:255',
           
        ];
    }


    public function messages(): array
    {
        return [
            'nom.required' => __('pkg_projets::tag/validation.nomRequired'),
            'nom.max' => __('pkg_projets::tag/validation.nomMax'),
            'description.max' => __('pkg_projets::tag/validation.descriptionMax'),
           
        ];
    }
}