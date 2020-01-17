<?php

namespace App\Http\Requests\Backend\TinhThanh;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTinhThanhRequest.
 */
class UpdateTinhThanhRequest extends FormRequest
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
        return [
            'tentinhthanh' => ['required', 'max:191'],
        ];
    }
}
