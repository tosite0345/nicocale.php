<?php

namespace App\Http\Requests\TeamUsers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Put extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'set_status'     => 'boolean',
            'notify_channel' => 'string|nullable',
            'remind_at'      => 'nullable|date_format:G:i:s',
            'skip_holiday'   => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'set_status'     => 'Slackステータス更新',
            'notify_channel' => '通知チャンネル',
            'remind_at'      => 'リマインド',
            'skip_holiday'   => '休日スキップ',
        ];
    }
}
