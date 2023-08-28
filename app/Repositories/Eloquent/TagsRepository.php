<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Interfaces\TagsRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TagsRepository implements TagsRepositoryInterface
{
    public function all()
    {
        return Tag::latest()->get();
    }

    public function get($where)
    {
        return Tag::where($where)->latest()->get();
    }

    public function paginate($page)
    {
        return Tag::latest()->paginate($page);
    }
    public function store($input)
    {
        $data = [
            'country_id' => $input['country'],
            'title' => $input['title'],
            'tag' => $input['tag'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'created_by' => Auth::guard('admin')->user()->id,
        ];
        return Tag::create($data);
    }

    public function find($id)
    {
        return Tag::find($id);
    }

    public function update($id, $input)
    {
        $data = [
            'country_id' => $input['country'],
            'title' => $input['title'],
            'tag' => $input['tag'],
            'status' => isset($input['status']) ? $input['status'] : 0,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];
        return Tag::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Tag::destroy($id);

    }

    public function forceDelete($id)
    {
        return Tag::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Tag::withTrashed()->findOrFail($id)->restore();
    }
}
