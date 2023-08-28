<?php

namespace App\Repositories\Eloquent;

use App\Models\Newsletter;
use App\Repositories\Interfaces\NewsletterRepositoryInterface;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class NewsletterRepository implements NewsletterRepositoryInterface
{
    public function all()
    {
        return Newsletter::all();

    }

    public function findById($id)
    {
        return Newsletter::findOrFail($id);
    }

    public function create(array $data)
    {
        $value = [
            'newsletter'  => $data['newsletter'],
            'status'      => $data['status'],
        ];
        return Newsletter::create($value);
    }

    public function update($id, array $data)
    {
        $value = [
            'newsletter' => $data['newsletter'],
            'status'     => $data['status'],
        ];
        return $this->findById($id)->update($value);
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}
