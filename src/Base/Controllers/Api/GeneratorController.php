<?php

namespace Isayama3\TheGenerator\Base\Controllers\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;
use Isayama3\TheGenerator\Base\Traits\SendResponse;

class GeneratorController extends Controller
{
    use SendResponse;
    protected $request;
    protected $model;
    
    public function __construct(FormRequest $request, Model $model)
    {
        $this->request = $request->validated();
        $this->model = $model;
    }

    public function index()
    {
        return $this->sendResponse([]);
    } 

    public function store()
    {
        $this->model = $this->model->create($this->request->validated());
        return $this->sendResponse(
            [],
            'successfully created.',
            true,
            201
        );
    }

    public function show($id)
    {
        return $this->sendResponse([]);
    }

    public function update($id)
    {
        $model = $this->model->find($id);
        $model->update($this->request->validated());
        $this->model = $model;

        return $this->sendResponse([]);
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return $this->ErrorMessage('not found.', 404);
        }
        $model->delete();
        return $this->sendResponse([], 'successfully deleted.');
    }
}
