<?php

namespace App\Repositories\Eloquent;

use App\Models\Preference;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PreferenceRepository implements PreferenceRepositoryInterface
{
    public function all()
    {
        return Preference::latest()->get();
    }

    public function get($where)
    {
        return Preference::where($where)->latest()->get();
    }

    public function getPrefrences()
    {
        return Preference::where('parent_preference_id', 0)->where('status', 1)->with([
            'children' => function ($query) {
                $query->with([
                    'children' => function ($query) {
                        $query->with(['children' => function ($query) {
                            $query->with('children');
                        }]);
                    }]);
            }])->get();
        //return Preference::where('parent_preference_id', 0)->where('status', 1)->with('children')->get();
    }

    public function paginate($page)
    {
        return Preference::latest()->paginate($page);
    }
    public function store($input)
    {
        $data = [
            'country_id' => isset($input['country']) ? $input['country'] : 0,
            'title' => $input['title'],
            'parent_preference_id' => $input['parent_preference_id'],
            'price' => $input['price'],
            'position' => $input['position'],
            'price_for_package' => isset($input['price_for_package']) ? $input['price_for_package'] : 0,
            'price_for_bundle' => isset($input['price_for_bundle']) ? $input['price_for_bundle'] : 0,
            'status' => isset($input['status']) ? $input['status'] : 0,
            'created_by' => Auth::guard('admin')->user()->id,
        ];
        return Preference::create($data);
    }

    public function find($id)
    {
        return Preference::find($id);
    }

    public function update($id, $input)
    {
        $data = [
            'country_id' => isset($input['country']) ? $input['country'] : 0,
            'title' => $input['title'],
            'parent_preference_id' => $input['parent_preference_id'],
            'price' => $input['price'],
            'position' => $input['position'],
            'price_for_package' => isset($input['price_for_package']) ? $input['price_for_package'] : 0,
            'price_for_bundle' => isset($input['price_for_bundle']) ? $input['price_for_bundle'] : 0,
            'status' => isset($input['status']) ? $input['status'] : 0,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];
        return Preference::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Preference::destroy($id);
    }

    public function forceDelete($id)
    {
        return Preference::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Preference::withTrashed()->findOrFail($id)->restore();
    }
}
