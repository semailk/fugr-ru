<?php

namespace App\Http\Requests;

use App\Models\Notebook;
use Illuminate\Foundation\Http\FormRequest;

class NotebookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static function rules()
    {
        return [
            Notebook::NOTEBOOK_FULL_NAME => 'required|min:3|max:255|string',
            Notebook::NOTEBOOK_EMAIL => 'required|min:3|max:150|email',
            Notebook::NOTEBOOK_DATE_OF_BIRTH => 'nullable|date_format:Y-m-d',
//            Notebook::NOTEBOOK_PHOTO => 'required|string|mimes:jpg,jpeg,png,bmp,tiff|max:4096',
            Notebook::NOTEBOOK_COMPANY => 'nullable|min:2|max:255',
            Notebook::NOTEBOOK_PHONE => 'required|string',
        ];
    }
}
