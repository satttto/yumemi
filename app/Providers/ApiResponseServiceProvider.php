<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * response macro
     *
     * @return void
     */
    public function boot()
    {
        // success, return 200
        // data format: 1.{"records": [{...}, {...}]} or 2. {"record": {...}}
        Response::macro('success', function ($message = '', $data = '', $code = Status::HTTP_OK) {
            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $code);
        });

        // error, return 400
        Response::macro('error', function ($message = '', $code = Status::HTTP_BAD_REQUEST) {
            return response()->json([
                'message'   => $message,
            ], $code);
        });
    }
}
