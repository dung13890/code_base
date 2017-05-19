<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Jobs\User\StoreJob;
use App\Jobs\User\UpdateJob;
use App\Jobs\User\DeleteJob;

class UserController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'email'];

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index(Request $request)
    {
        $this->before(__FUNCTION__);
        parent::index($request);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params);
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
        parent::create();

        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->before(__FUNCTION__);
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->doRequest(function () use ($data) {
            return $this->dispatch(new StoreJob($data));
        });
    }
}
