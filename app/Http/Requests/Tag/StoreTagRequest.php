<?php

namespace App\Http\Requests\Tag;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreTagRequest extends FormRequest
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
            'name'=> 'required|string',
        ];
    }

    protected  function failedValidation(Validator $validator)
    {
        $errors= $this->returnValidationError($validator->errors());
        throw new ValidationException( $validator, $errors);

    }
}
