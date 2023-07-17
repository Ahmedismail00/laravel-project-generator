<?php

namespace TheGenerator\Base\Controllers\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;
use TheGenerator\Base\Traits\SendResponse;

class GeneratorController extends Controller
{
    use SendResponse;
    protected $request;
    protected $model;
    protected $resource;
    
    public function __construct(FormRequest $request, Model $model, $resource)
    {
        $this->request = $request;
        $this->model = $model;
        $this->resource = $resource;
    }

    public function index()
    {
        return $this->sendResponse($this->resource::collection($this->model->paginate($this->request->per_page ?? 10)));
    } 

    public function store()
    {
        $this->model = $this->model->create($this->request->validated());
        return $this->sendResponse();
    }

    public function show($id)
    {
        return $this->sendResponse();
    }

    public function update($id)
    {
        $model = $this->model->find($id);
        $model->update($this->request->validated());
        $this->model = $model;

        return $this->sendResponse();
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return $this->ErrorMessage('not found.', 404);
        }
        $model->delete();
        return $this->sendResponse();
    }
}
