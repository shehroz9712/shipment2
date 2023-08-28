<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function all()
    {
        return Transaction::latest()->paginate(10);
    }

    public function find($id)
    {
        return Transaction::findOrFail($id);
    }

    public function get($where = [])
    {
        return Transaction::where($where)->latest()->get();
    }

    public function getTransactionById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Transaction::where('id', $id);

        if (count($whereClauses) > 0) {
            foreach ($whereClauses as $column => $value) {
                $query->where($column, $value);
            }
        }

        if (count($withClauses) > 0) {
            $query->with($withClauses);
        }

        return $query->first();
    }

    public function paginate($page)
    {
        return Transaction::latest()->paginate($page);
    }

    public function store($data)
    {
        $value = [
            ''
        ];
        return $data;
        return Transaction::create($value);
    }

    public function update($id, $data)
    {
        $value = [
            ''
        ];
        return $data;
        return $this->find($id)->update($value);
    }

    public function destroy($id)
    {
        return $id;
        return $this->find($id)->destroy($id);
    }

    public function forceDelete($id)
    {
        return $this->find($id)->forceDelete();
    }

    public function recover($id)
    {
        return Transaction::withTrashed()->findOrFail($id)->restore();
    }
}
