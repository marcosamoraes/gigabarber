<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $client = $this->route('client');
        return [
            'name'          => ['nullable'],
            'email'         => ['email', Rule::unique('clients')->ignore($client), 'required'],
            'password'      => ['nullable'],
            'slug'          => [Rule::unique('clients')->ignore($client), 'required'],
            'whatsapp'      => ['nullable'],
            'company_name'  => [Rule::unique('clients')->ignore($client), 'required'],
            'whatsapp'      => ['nullable'],
            'logo'          => ['nullable', 'image'],
            'favicon'       => ['nullable', 'image'],

            'attributes.title'               => ['required'],
            'attributes.description'         => ['nullable'],
            'attributes.public_email'        => ['email', 'nullable'],
            'attributes.image'               => ['image', 'nullable'],
            'attributes.primary_color'       => ['nullable'],
            'attributes.text_color'          => ['nullable'],
            'attributes.description_footer'  => ['nullable'],
            'attributes.link_facebook'       => ['url', 'nullable'],
            'attributes.link_instagram'      => ['url', 'nullable'],
            'attributes.opening_hours'       => ['nullable'],

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
