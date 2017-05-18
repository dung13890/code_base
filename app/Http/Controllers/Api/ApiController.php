<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;

class ApiController extends AbstractController
{
    protected $guard = 'api';

    protected $dataSelect = ['*'];

    protected function jsonRender($data = [])
    {
        $this->compacts['message'] = [
            'code' => 200,
            'status' => true,
        ];

        $compacts = array_merge($data, $this->compacts);

        return response()->json($compacts);
    }

    protected function doRequest(callable $callback)
    {
        \DB::beginTransaction();
        try {
            if (is_callable($callback)) {
                call_user_func_array($callback, []);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
        }

        return $this->jsonRender();
    }
}
