<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\AbstractController;
use Exception;
use DB;

abstract class ApiController extends AbstractController
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
        DB::beginTransaction();
        try {
            if (is_callable($callback)) {
                call_user_func_array($callback, []);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $this->jsonRender();
    }

    protected function before($action, $object = null)
    {
        $action = in_array($action, ['index','show']) ? 'read' : 'write';
        
        if ($object == null) {
            $object = $this->repository->model();
        }

        if (!$this->user || $this->user->cannot($action, $object)) {
            throw new Exception("Unauthenticated", 401);
        }

        return true;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $this->compacts['items'] = $this->repository->getData($params, $this->dataSelect);
    }

    public function show($id)
    {
        $this->compacts['item'] = $this->repository->findOrFail($id);
    }
}
