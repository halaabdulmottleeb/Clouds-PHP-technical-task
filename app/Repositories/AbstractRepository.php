<?php

namespace App\Repositories;

use App\Exceptions\QueryException;
use App\Repositories\Tenant\RepositoryInterface;
use Illuminate\Support\Facades\Log;

class AbstractRepository
{
    public $model;

    public function create($data =[])
    {

        try {
            $item = $this->model->query()->create($data);
            return $item;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException($exception->getMessage());
        }

    }
    public function updateWhere($col, $value, $data =[]) {
        try {
            $this->model->where($col, $value)->update($data);
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException($exception->getMessage());
        }
    }
    public function update($item, $data)
    {
        try {
            $item->update($data);
            return $item;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException($exception->getMessage());
        }
    }
    public function updateOrCreate($itemIfExist, $data)
    {
        try {
            $item = $this->model->query()->updateOrCreate($itemIfExist,$data);
            return $item;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function updateWhereIn($column , $value, $data)
    {
        try {
            $item = $this->model->query()->whereIn($column, $value)->update($data);
            return $item;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function findAll($filters = [], $with = [], $returnResults = true, $orderBy = 'id', $direction = 'DESC' , $pagination = false , $perPage = 5)
    {
            $query = $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderBy($orderBy, $direction);

        return $returnResults ? $pagination ? $query->paginate($perPage) : $query->get() : $query;
    }

    public function findAllNot($filters = [], $notFilter = [], $notArray = [], $with = [], $returnResults = true, $orderBy = 'id', $direction = 'DESC')
    {
        $query = $this->model->query()
            ->where($filters)
            ->whereNotIn($notFilter, $notArray)
            ->with($with)
            ->orderBy($orderBy, $direction);

        return $returnResults ? $query->get() : $query;
    }

    public function findAllByWhereIn($column, $value, $with = [], $returnResults = true, $orderBy = 'id',
                                     $direction = 'DESC', $pagination = false, $perPage = 5)
    {
        try {
            $query = $this->model->query()
                ->whereIn($column, $value)
                ->with($with)
                ->orderBy($orderBy, $direction);
            return $returnResults ? $pagination ? $query->paginate($perPage) : $query->get() : $query;

        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }


    public function findAllByWhereNotIn($column , $value, $with = [], $returnResults = true,$orderBy = 'id',$direction = 'DESC')
    {
        try {
            $query = $this->model->query()
                ->whereNotIn($column, $value)
                ->with($with)
                ->orderBy($orderBy, $direction);
            return $returnResults ? $query->get() : $query;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function findAllWithPaging($filters = [], $with = [], $limit = 10, $offset = 0, $returnResults = true,$orderBy = 'id',$direction = 'DESC')
    {
        $limit = isset($limit) ? $limit : 10;
        $offset = isset($offset) ? $offset : 0;
        try {
            $query = $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderBy($orderBy, $direction);
            return $returnResults ? $query->limit($limit)->offset($offset)->get() : $query;
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function findOneBy($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->first();
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException($exception->getMessage());
        }
    }
    public function findOneByOrFail($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->firstOrFail();
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function delete($id)
    {
            return $this->model->destroy($id);
        
    }
    public function getItem($idOrModel)
    {
        try {
            return gettype($idOrModel) == 'object' ? $idOrModel : $this->model->find($idOrModel);
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function firstOrCreate($data)
    {
        try {
            return $this->model->query()->firstOrCreate($data);
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('something went wrong');
        }
    }
    public function sync($item,$modelRelation,$data)
    {
        try {
            return $item->$modelRelation()->sync($data);
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function deleteCollection($filters)
    {
        try {
            return $this->model->where($filters)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }
    public function deleteWhereIn($ids)
    {
        try {
            return $this->model->whereIn('id', $ids)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException('Something went wrong');
        }
    }

    public function updateAllWhere($col = [], $data = [])
    {
        try {
            $this->model->where($col)->update($data);
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::debug($exception);
            throw new QueryException($exception->getMessage());
        }

    }

    public function deleteAll()
    {
        try {
            $this->model->truncate();
        } catch (\Illuminate\Database\QueryException $exception) {
           dd($exception->getMessage());
            throw new QueryException($exception->getMessage());
        }

    }
}