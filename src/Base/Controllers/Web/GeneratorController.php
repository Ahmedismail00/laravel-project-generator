<?php

namespace Isayama3\TheGenerator\Base\Controllers\Web;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class GeneratorController extends Controller
{
    
    protected $request;
    protected $model;
    // protected $resource;
    protected $view_path;
    protected $route_name;

    public function __construct(FormRequest $request, Model $model, string $view_path, string $route_name)
    {
        $this->request = $request;
        $this->model = $model;
        // $this->resource = $resource;
        $this->view_path = $view_path;
        $this->route_name = $route_name;
    }

    public function index()
    {
        $records = $this->model->paginate(10);
        return view($this->view_path . 'index', compact('records'));
    } 

    public function create()
    {
        $record = $this->model->get();
        return $this->view($this->view_path, compact('record'));
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $this->model = $this->model->create($this->request->validated());
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }

        DB::commit();
        // TODO:: LOG AND FLUSH MESSAGE
        // session()->flash('success', __('تم الإضافة'));
        return redirect(route($this->route_name.'.index'));

    }

    public function show($id)
    {
        $record = $this->model->findOrFail($id);
        return view($this->view_path . 'show', compact('record'));

    }

    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        $edit = true;
        return $this->view('edit', compact('record', 'edit'));
    }

    public function update($id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->find($id);
            $model->update($this->request->validated());
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }

        DB::commit();
        // TODO:: LOG AND FLUSH MESSAGE
        // session()->flash('success', __('تم الإضافة'));
        return redirect(route($this->route_name.'.index'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->find($id);
            $model->delete(); 
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    
        DB::commit();
                // TODO:: LOG AND FLUSH MESSAGE
        // session()->flash('success', __('تم الإضافة'));
        return redirect(route($this->route_name.'.index'));
    }
}