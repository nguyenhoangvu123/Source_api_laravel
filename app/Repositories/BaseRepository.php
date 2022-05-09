<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     *   get instant model 
     *   @return, instant model 
     */

    abstract function getModel();

    /**
     * set model and auto new model 
     * @return, instant model 
     */
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }
    /**
     * get list record in model
     * @return object
     */

    public function gettAlls()
    {
        $result = $this->model->all();
        return $result;
    }

    /**
     * select one record on model 
     * @param, id TYPE[int]
     * @return object
     */

    public function find($id)
    {
        $result = $this->model->find($id);
        if (!$result)
            throw new ModelNotFoundException(404, 'Model not found !');
        return $result;
    }

    /**
     * create record model
     * @param, attributes TYPE[array]
     * @return object
     */

    public function created($attributes)
    {
        $result = $this->model->created($attributes);
        return $result;
    }

    /**
     * update record model
     * @param, id TYPE[int]  ,attributes TYPE[array]
     * @return object
     */

    public function updated($id, $attributes)
    {
        $result = $this->find($id);
        $result->update($attributes);
        return $result;
    }

    /**
     * delete reco model
     * @param, id TYPE[int] 
     * @return boolean
     */

    public function delete($id)
    {
        $result = $this->find($id);
        $result->delete();
        return true;
    }
}
