<?php

namespace App\Repositories;

interface EloquentRepositoryInterface
{
    public function all();

    public function count();

    public function create(array $aData);

    public function createMultiple(array $aData);

    public function delete();

    public function deleteById(int $iId);

    public function deleteMultipleById(array $aIds);

    public function first();

    public function get();

    public function getById(int $iId);

    public function limit(int $iLimit);

    public function orderBy(string $sColumn, string $sDirection);

    public function updateById(int $iId, array $aData);

    public function where(string $sColumn, $mValue, string $sOperator = '=');

    public function whereIn(string $sColumn, $mValues);

    public function with($mRelations);

    public function paginate(int $iLimit);
}
