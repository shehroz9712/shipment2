<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\SmsResponderRepositoryInterface;
use App\Models\SmsResponder;

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
    public function store($data)
    {
        $input = $data;
        $data = [
            'website_id' => 1,
            'title' => $input['title'],
            'from_email' => $input['from_email'],
            'to_email' => $input['to_email'],
            'subject' => $input['subject'],
            'content' => $input['content'],
            'status' => isset($input['status']) ? $input['status'] : 0
        ];
        return SmsResponder::create($data);
    }

    public function find($id)
    {
        return SmsResponder::find($id);
    }

    public function update($data, $id)
    {
        $input = $data;
        $data = [
            'website_id' => 1,
            'title' => $input['title'],
            'from_email' => $input['from_email'],
            'to_email' => $input['to_email'],
            'subject' => $input['subject'],
            'content' => $input['content'],
            'status' => isset($input['status']) ? $input['status'] : 0
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