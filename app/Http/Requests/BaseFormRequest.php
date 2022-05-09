<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
   /**
    * custom respone data validation fail 
    * @param $input 
    * @param $error TYPE array
    * @return json 
    */
    public function failedResponse($input, $errors)
    {
        Log::channel('validation')->error($input);
        Log::channel('validation')->error($errors);

        $errorsData = [
            'success' => false,
            'status_code' => 422,
            'message' => 'Validation Failed',
            'data' => null,
            'errors' => $errors,
        ];

        throw new HttpResponseException(response()->json($errorsData, 422));
    }

    /**
     * hanlde validation error and call function failerReponse send reposone client
     * @param $validation TYPE object
     * @return json
     */

    protected function failedValidation(Validator $validator)
    {
        $ex = new ValidationException($validator);
        $errors = $ex->errors();
        $input = $validator->attributes();
        $this->failedResponse($input, $errors);
    }
}
