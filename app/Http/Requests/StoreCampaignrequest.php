<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignrequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"=>"required|string",
            "start_date"=>"required|date",
            "end_date"=>"required|date",
            "platform"=>"required",
            "category_id"=>"required|numeric",
            "college_id"=>"nullable|integer",
            "university_id"=>"nullable|integer",
            "year_id"=>"nullable|integer",
            "stage_id"=>"nullable|integer",
        ];
    }
}
