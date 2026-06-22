<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền tạo bài viết không.
     * Đổi thành true để cho phép tất cả (trong lab chưa có xác thực phức tạp).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc validation cho form tạo bài viết mới.
     */
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh bằng tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Tiêu đề bài viết không được để trống.',
            'title.min'        => 'Tiêu đề phải có ít nhất :min ký tự.',
            'title.max'        => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min'      => 'Nội dung phải có ít nhất :min ký tự.',
        ];
    }

    /**
     * Tên hiển thị của từng field trong thông báo lỗi mặc định.
     */
    public function attributes(): array
    {
        return [
            'title'   => 'tiêu đề',
            'content' => 'nội dung',
        ];
    }
}
