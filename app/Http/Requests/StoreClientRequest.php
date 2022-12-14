<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'          => ['nullable'],
            'email'         => ['email', Rule::unique('clients'), 'required'],
            'password'      => ['nullable'],
            'slug'          => [Rule::unique('clients'), 'required'],
            'whatsapp'      => ['nullable'],
            'company_name'  => [Rule::unique('clients'), 'required'],
            'whatsapp'      => ['nullable'],
            'logo'          => ['nullable', 'image'],
            'profile'       => ['nullable', 'image'],
            'favicon'       => ['nullable', 'image'],

            'attributes.public_email'        => ['email', 'nullable'],
            'attributes.primary_color'       => ['nullable'],
            'attributes.text_color'          => ['nullable'],
            'attributes.description_footer'  => ['nullable'],
            'attributes.link_facebook'       => ['url', 'nullable'],
            'attributes.link_instagram'      => ['url', 'nullable'],
            'attributes.opening_hours'       => ['nullable'],
            'attributes.time_interval'       => ['nullable'],

            'address.cep'          => ['required', 'max:8'],
            'address.address'      => ['required', 'max:50'],
            'address.number'       => ['required', 'max:4'],
            'address.area'         => ['required', 'max:50'],
            'address.complement'   => ['nullable', 'max: 50'],
            'address.city'         => ['required', 'max:50'],
            'address.state'        => ['required', 'max:2'],
        ];
    }
}
