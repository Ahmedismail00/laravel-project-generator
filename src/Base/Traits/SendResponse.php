<?php

namespace Isayama3\TheGenerator\Base\Traits;

use Illuminate\Support\Facades\Route;

trait SendResponse
{
    // TODO :: Search for the best api response 
    /**
     * send the response
     *
     * @param array $result
     * @param string $message
     * @param bool $is_success
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result = [], $message = 'Success.', $is_success = true, $status_code = 200, $customModel = false)
    {

        $result_key = $is_success ? 'data' : 'errors';

        $response = [
            'endpointName' => app('request')->route()->getName(),
            'is_success' => $is_success,
            'status_code' => $status_code,
            'message' => $message,
            "current_page" => request()->page ?? 1,
            "total" => $customModel > 0 ? $customModel : (isset($this->model) ? $this->model->count() : 0),
            "per_page" => request()->per_page ? (int) request()->per_page : 10,
            "pages" => 0,

            $result_key => $result,
        ];

        $response["pages"] = ceil($response["total"] / $response["per_page"]);

        // for paginated data
        if (isset($result['data']) && isset($result['links']) && isset($result['meta'])) {
            $response['data'] = $result['data'];
            $response['links'] = $result['links'];
            $response['meta'] = $result['meta'];
        }

        return response()->json($response, $status_code);
    }

    /**
     * send the exception response
     *
     * @param \Exception $e
     * @param bool $report
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendExceptionResponse($e, $report = true)
    {
        if ($report) {
            report($e);
        }

        $message = 'OOPS! there is a problem in our side! we got your problem and we will fix that very soon.';

        return $this->sendResponse([], $message, false, 500);
    }

    public function ErrorMessage($msg)
    {
        return $this->sendResponse(
            ['msg' => $msg],
            $msg,
            false,
            422
        );
    }
    public function SuccessMessage($msg)
    {
        return $this->sendResponse(
            ['msg' => $msg],
            $msg,
            true,
            200
        );
    }

    public function shortSuccess($data)
    {
        return $this->sendResponse(
            $data,
            'تم',
            true,
            200
        );
    }
}