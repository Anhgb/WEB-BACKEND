<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền cập nhật bài viết không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc validation cho form cập nhật bài viết.
     * Route Model Binding: $this->route('post') trả về object Post hiện tại.
     */
    public function rules(): array
    {
        // Lấy post từ route parameter để dùng khi cần ignore unique (ví dụ slug)
        $post = $this->route('post');

        return [
            'title'   => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            // Ví dụ nếu thêm slug sau này:
            // 'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
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
