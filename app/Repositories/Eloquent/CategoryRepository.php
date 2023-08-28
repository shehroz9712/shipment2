<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryRepository implements CategoryRepositoryInterface
{

    public function all()
    {
        return Category::latest()->paginate(10);
    }
    public function get($where = [])
    {

        $result = Category::latest();

        if (!empty($where)) {
            $result->where($where);
        }
        // if (!empty($with)) {
        //     $result->with($with);
        // }
        return $result->get();
    }
    public function paginate($page)
    {
        return Category::latest()->paginate($page);
    }
    public function store($data)
    {
        if (isset($data['image'])) {
            $image = uploadSingleImage($data['image'], 'uploads/images/categories/');
        }


        $value = [
            'title'                  => $data['title'],
            'image'                  => isset($image) ? $image : null,
            'is_main'                => $data['is_main'],
            'position'               => $data['position'],
            'preferences_show'       => $data['preferences_show'],
            'message'                => $data['popup_message'],
            'created_by'             => Auth::user()->id,
            'status'                 => $data['status'] ?? 0,
        ];

        return Category::create($value);
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function update($data, $id)
    {
        if (isset($data['image'])) {
            $image = uploadSingleImage($data['image'], 'uploads/images/categories/');
        }

        $value = [
            'title'                  => $data['title'],
            'image'                  => isset($image) ? $image : null,
            'is_main'                => $data['is_main'],
            'position'               => $data['position'],
            'preferences_show'       => $data['preferences_show'],
            'popup_message'          => $data['popup_message'],
            'created_by'             => Auth::user()->id,
            'status'                 => $data['status'] ?? 0,
        ];

        return $this->find($id)->update($value);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        return $category->delete();
    }

    public function recover($id)
    {
        return Category::withTrashed()->find($id)->restore();
    }
}
