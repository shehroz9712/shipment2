<?php

namespace App\Repositories\Eloquent;

use App\Models\SmsResponder;
use App\Repositories\Interfaces\SmsResponderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SmsResponderRepository implements SmsResponderRepositoryInterface
{
    public function all()
    {
        return SmsResponder::latest()->get();
    }

    public function get($where = [])
    {
        return SmsResponder::where($where)->latest()->get();
    }

    public function paginate($page)
    {
        return SmsResponder::latest()->paginate($page);
    }
    public function store($input)
    {
        $data = [
            'country_id' => $input['country'],
            'title' => $input['title'],
            'content' => $input['content'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'created_by' => Auth::guard('admin')->user()->id
        ];
        return SmsResponder::create($data);
    }

    public function find($id)
    {
        return SmsResponder::find($id);
    }

    public function update($id, $input)
    {
        //$input = $data;
        $data = [
            'country_id' => $input['country'],
            'title' => $input['title'],
            'content' => $input['content'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'updated_by' => Auth::guard('admin')->user()->id
        ];
        return SmsResponder::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return SmsResponder::destroy($id);

    }

    public function forceDelete($id)
    {
        return SmsResponder::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return SmsResponder::withTrashed()->findOrFail($id)->restore();
    }
}
