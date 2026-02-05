<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartitRequest extends FormRequest
{
    public function authorize()
    {
        return true; // o auth()->check() si quieres proteger
    }

    public function rules()
    {
        return [
            'equip_local_id' => ['required', 'exists:equips,id'],
            'equip_visitant_id' => ['required', 'exists:equips,id', 'different:equip_local_id'],
            'resultat' => ['nullable', 'string', 'max:20'],
            'estadi_id' => ['required', 'exists:estadis,id'],
        ];
    }

    public function messages()
    {
        return [
            'equip_visitant_id.different' => 'L\'equip visitant ha de ser diferent del local',
        ];
    }
}