<?php

declare(strict_types=1);

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:300'],
            'description' => ['required', 'max:1000'],
            'photos' => ['required', 'array', 'max:3']
        ];
    }

    public function getInputData(): AnnouncementData
    {
        return new AnnouncementData(
            $this->input('name'),
            (float) $this->input('price'),
            $this->input('description'),
            $this->input('photos'),
        );
    }
}
