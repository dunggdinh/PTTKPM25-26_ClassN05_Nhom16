<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendSupportMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        // đã có middleware auth phía ngoài; ở đây luôn cho phép
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:5000'],
            // 'attachments.*' => ['file','max:5120'], // nếu sau này thêm file
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung.',
        ];
    }
}
