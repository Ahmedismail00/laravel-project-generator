<?php

namespace TheGenerator\Base\Traits;

use Illuminate\Support\Facades\Route;

trait SendResponse
{
    // TODO :: Search for the best api response 
    
    public function sendResponse($result = [], string $message = '', bool $is_success = true, int $status_code = 200)
    {
        //
    }

    protected function sendExceptionResponse($e, $report = true)
    {
        //
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
            'done',
            true,
            200
        );
    }
}