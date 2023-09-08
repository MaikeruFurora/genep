<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BPMasterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code'  => 'required|unique:bp_master_data,code,'.$this->id,
            'name'  => 'max:100|unique:bp_master_data,name,'.$this->id,
            // 'tin'   => 'max:30|unique:bp_master_data,tin,'.$this->id,
        ];
    }
}
