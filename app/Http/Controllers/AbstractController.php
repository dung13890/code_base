<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class AbstractController extends Controller
{
    protected $repository;

    protected $repositoryName;

    protected $user;

    protected $compacts;

    public function __construct($repository = null)
    {
        $this->middleware(function ($request, $next) use ($repository) {
            $this->user = Auth::guard($this->getGuard())->user();

            if ($repository) {
                $this->repositorySetup($repository);
            }
            
            return $next($request);
        });
    }

    protected function repositorySetup($repository = null)
    {
        $this->repository = $repository->setUserId($this->user->id);
        $this->repositoryName = strtolower(class_basename($this->repository->model()));
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}