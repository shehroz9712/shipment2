<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\EmailResponderRepositoryInterface;
use App\Models\EmailResponder;
use Illuminate\Support\Facades\Auth;

class EmailResponderRepository implements EmailResponderRepositoryInterface
{
    public function all()
    {
        return EmailResponder::latest()->get();
    }

    public function get($where = [])
    {
        return EmailResponder::where($where)->latest()->get();
    }

    public function paginate($page)
    {
        return EmailResponder::latest()->paginate($page);
    }
    public function store($data)
    {
        $input = $data;
        $data = [
            'title' => $input['title'],
            'from_email' => $input['from_email'],
            'to_email' => $input['to_email'],
            'subject' => $input['subject'],
            'content' => $input['content'],
            'created_by' => Auth::guard('admin')->user()->id,
            'status' => isset($input['status']) ? $input['status'] : 0,
        ];
        return EmailResponder::create($data);
    }

    public function find($id)
    {
        return EmailResponder::find($id);
    }

    public function update($data, $id)
    {
        $input = $data;
        $data = [
            'title' => $input['title'],
            'from_email' => $input['from_email'],
            'to_email' => $input['to_email'],
            'subject' => $input['subject'],
            'content' => $input['content'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'updated_by' => Auth::guard('admin')->user()->id


        ];
        return EmailResponder::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return EmailResponder::destroy($id);
    }

    public function forceDelete($id)
    {
        return EmailResponder::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return EmailResponder::withTrashed()->findOrFail($id)->restore();
    }
}
