<?php

namespace App\Http\Requests\Backend\DacSan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateDacSanRequest.
 */
class UpdateDacSanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->isAdmin();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // return true;
        return [
            'tendacsan' => ['required', 'max:191'],
        ];
    }
}
