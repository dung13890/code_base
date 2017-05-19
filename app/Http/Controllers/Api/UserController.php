<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Jobs\User\StoreJob;
use App\Contracts\Repositories\UserRepository;

class UserController extends ApiController
{
    protected $dataSelect = [ 'name', 'email'];

    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function index(Request $request)
    {
        try {
            $this->compacts['items'] = $this->repository->getData($this->dataSelect);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $this->jsonRender();
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->doRequest(function () use ($data) {
            return $this->dispatch(new StoreJob($data));
        });
    }
}
