<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * response macro
     *
     * @return void
     */
    public function boot()
    {
        // success
        Response::macro('success', function ($data = [], $code = 200) {
            return response()->json([
                'status_code'  => $code,
                'data' => $data,
            ], $code);
        });

        // error
        Response::macro('error', function ($errMsg = '', $code = 400) {
            return response()->json([
                'status_code'  => $code,
                'error_message'   => $errMsg,
            ], $code);
        });
    }
}
