<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
            //
            'departement_id' => 'required|integer',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'montant_journalier' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'le departement est requis',
            'nom.required' => 'le nom est requis',
            'prenom.required' => 'le prenom est requis',
            'email.required' => 'l email est requis',
            'contact.required' => 'le telephone est requis',
            'montant_journalier.required' => 'le montant journalier est requis',
            ];
    }
}
