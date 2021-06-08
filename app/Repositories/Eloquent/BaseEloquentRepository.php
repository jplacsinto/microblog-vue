<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Abstract class for the base eloquent repository
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
abstract class BaseEloquentRepository implements EloquentRepositoryInterface
{

    /**
     * The repository model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $oModel;


    /**
     * The query builder
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $oQuery;


    /**
     * Alias for the query limit
     *
     * @var int
     */
    protected $iTake;


    /**
     * Array of related models to eager load
     *
     * @var array
     */
    protected $aWith = array();


    /**
     * Array of one or more where clause parameters
     *
     * @var array
     */
    protected $aWheres = array();


    /**
     * Array of one or more where in clause parameters
     *
     * @var array
     */
    protected $aWhereIns = array();


    /**
     * Array of one or more ORDER BY column/value pairs
     *
     * @var array
     */
    protected $aOrderBys = array();


    /**
     * Array of scope methods to call on the model
     *
     * @var array
     */
    protected $aScopes = array();


    /**
     * Get all the model records in the database
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $this->newQuery()->eagerLoad();

        $oModels = $this->oQuery->get();

        $this->unsetClauses();

        return $oModels;
    }


    /**
     * Count the number of specified model records in the database
     *
     * @return int
     */
    public function count()
    {
        return $this->get()->count();
    }


    /**
     * Create a new model record in the database
     *
     * @param array $aData
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $aData)
    {
        $this->unsetClauses();

        return $this->oModel->create($aData);
    }


    /**
     * Create one or more new model records in the database
     *
     * @param array $aData
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(array $aData)
    {
        $oModels = new Collection();

        foreach ($aData as $aThisData) {
            $oModels->push($this->create($aThisData));
        }

        return $oModels;
    }


    /**
     * Delete one or more model records from the database
     *
     * @return mixed
     */
    public function delete()
    {
        $this->newQuery()->setClauses()->setScopes();

        $mResult = $this->oQuery->delete();

        $this->unsetClauses();

        return $mResult;
    }


    /**
     * Delete the specified model record from the database
     *
     * @param $iId
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deleteById(int $iId)
    {
        $this->unsetClauses();

        return $this->getById($iId)->delete();
    }


    /**
     * Delete multiple records
     *
     * @param array $aIds
     *
     * @return int
     */
    public function deleteMultipleById(array $aIds)
    {
        return $this->oModel->destroy($aIds);
    }


    /**
     * Get the first specified model record from the database
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first()
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $oModel = $this->oQuery->firstOrFail();

        $this->unsetClauses();

        return $oModel;
    }


    /**
     * Get all the specified model records in the database
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $oModels = $this->oQuery->get();

        $this->unsetClauses();

        return $oModels;
    }


    /**
     * Get the specified model record from the database
     *
     * @param $iId
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById(int $iId)
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->oQuery->findOrFail($iId);
    }


    /**
     * Set the query limit
     *
     * @param int $iLimit
     *
     * @return $this
     */
    public function limit(int $iLimit)
    {
        $this->iTake = $iLimit;

        return $this;
    }


    /**
     * Set an ORDER BY clause
     *
     * @param string $sColumn
     * @param string $sDirection
     *
     * @return $this
     */
    public function orderBy(string $sColumn, string $sDirection = 'asc')
    {
        $this->aOrderBys[] = compact('sColumn', 'sDirection');

        return $this;
    }


    /**
     * Update the specified model record in the database
     * @param       $iId
     * @param array $aData
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateById(int $iId, array $aData)
    {
        $this->unsetClauses();

        $oModel = $this->getById($iId);

        $oModel->update($aData);

        return $oModel;
    }


    /**
     * Add a simple where clause to the query
     *
     * @param string $sColumn
     * @param string $mValue
     * @param string $sOperator
     *
     * @return $this
     */
    public function where(string $sColumn, $mValue, string $sOperator = '=')
    {
        $this->aWheres[] = compact('sColumn', 'mValue', 'sOperator');

        return $this;
    }


    /**
     * Add a simple where in clause to the query
     *
     * @param string $sColumn
     * @param mixed  $mValues
     *
     * @return $this
     */
    public function whereIn(string $sColumn, $mValues)
    {
        $mValues = is_array($mValues) ? $mValues : array($mValues);

        $this->aWhereIns[] = compact('sColumn', 'mValues');

        return $this;
    }


    /**
     * Set Eloquent relationships to eager load
     *
     * @param $mRelations
     *
     * @return $this
     */
    public function with($mRelations)
    {
        if (is_string($mRelations)) {
            $mRelations = func_get_args();
        }

        $this->aWith = $mRelations;

        return $this;
    }

    public function paginate(int $iLimit)
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $oModels = $this->oQuery->paginate($iLimit);

        $this->unsetClauses();

        return $oModels;
    }


    /**
     * Create a new instance of the model's query builder
     *
     * @return $this
     */
    protected function newQuery()
    {
        $this->oQuery = $this->oModel->newQuery();

        return $this;
    }


    /**
     * Add relationships to the query builder to eager load
     *
     * @return $this
     */
    protected function eagerLoad()
    {
        foreach ($this->aWith as $mRelation) {
            $this->oQuery->with($mRelation);
        }

        return $this;
    }


    /**
     * Set clauses on the query builder
     *
     * @return $this
     */
    protected function setClauses()
    {
        foreach ($this->aWheres as $where) {
            $this->oQuery->where($where['sColumn'], $where['sOperator'], $where['mValue']);
        }

        foreach ($this->aWhereIns as $whereIn) {
            $this->oQuery->whereIn($whereIn['sColumn'], $whereIn['mValues']);
        }

        foreach ($this->aOrderBys as $orders) {
            $this->oQuery->orderBy($orders['sColumn'], $orders['sDirection']);
        }

        if (isset($this->iTake) and ! is_null($this->iTake)) {
            $this->oQuery->take($this->iTake);
        }

        return $this;
    }


    /**
     * Set query scopes
     *
     * @return $this
     */
    protected function setScopes()
    {
        foreach ($this->aScopes as $sMethod => $aArgs) {
            $this->oQuery->$sMethod(implode(', ', $aArgs));
        }

        return $this;
    }


    /**
     * Reset the query clause parameter arrays
     *
     * @return $this
     */
    protected function unsetClauses()
    {
        $this->aWheres   = array();
        $this->aWhereIns = array();
        $this->aScopes   = array();
        $this->iTake     = null;

        return $this;
    }
}
