<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Jobs\User\StoreJob;
use App\Jobs\User\UpdateJob;
use App\Jobs\User\DeleteJob;
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
        $this->before(__FUNCTION__);
        parent::index($request);

        return $this->jsonRender();
    }

    public function store(Request $request)
    {
        $this->before(__FUNCTION__);
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->doRequest(function () use ($data) {
            $this->dispatch(new StoreJob($data));
        });
    }

    public function show($id)
    {
        parent::show($id);
        $this->before(__FUNCTION__, $this->compacts['item']);

        return $this->jsonRender();
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->before(__FUNCTION__, $item);
        $this->validate($request, $this->repository->validation('update', $item));
        $data = $request->all();

        return $this->doRequest(function () use ($item, $data) {
            $this->dispatch(new UpdateJob($item, $data));
        });
    }

    public function destroy($id)
    {
        $item = $this->repository->findOrFail($id);
        $this->before(__FUNCTION__, $item);
        
        return $this->doRequest(function () use ($item) {
            $this->dispatch(new DeleteJob($item));
        });
    }
}
