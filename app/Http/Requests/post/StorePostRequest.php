<?php

namespace App\Http\Requests\post;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePostRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=> 'required|string',
            'body'=> 'required|string',
            'image'=> 'required|image',
            'category'=> 'required|exists:categories,id',

        ];
    }

    protected  function failedValidation(Validator $validator)
    {
        $errors= $this->returnValidationError($validator->errors());
        throw new ValidationException( $validator, $errors);

    }
}
