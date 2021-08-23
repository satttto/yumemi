<?php

namespace App\Http\Requests;

use App\Services\TaskService;
use \Symfony\Component\HttpFoundation\Response as Status;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\QueryException;

class AchievementRequest extends FormRequest
{

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Make it false when authentication is set
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $that = $this;
        return [
            'task_ids' => [
                function ($attribute, $value, $fail) use ($that) {
                    // リクエストで送られたタスクIDが本当に存在するかどうかを確認する
                    try {
                        if (!$that->taskService->existAll($value)) {
                            return $fail('Invalid task ids were included.');
                        }
                    } catch(QueryException $e) {
                        $res = response()->error('Bad Request', Status::HTTP_BAD_REQUEST);
                        throw new HttpResponseException($res);
                    }
                }
            ]
        ];
    }

    /**
     * Failure message
     */
    protected function failedValidation(Validator $validator) 
    {
        $res = response()->error($validator->errors(), Status::HTTP_BAD_REQUEST);
        throw new HttpResponseException($res);
    }

}
