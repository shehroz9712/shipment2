<?php

namespace App\Repositories\Eloquent;

use App\Models\FranchiseService;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use App\Models\ServicePrice;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function all()
    {
        return Service::latest()->get();
    }

    public function get($where = [])
    {
        return Service::where($where)->latest()->get();
    }

    public function getServicesWith($with = [])
    {
        return Service::with($with)->latest()->get();
    }

    public function getServiceById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Service::where('id', $id);

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
        return Service::latest()->paginate($page);
    }

    public function find($id)
    {
        return Service::find($id);
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $image       = uploadSingleImage($data['image'], 'uploads/images/categories/');
        }

        if (isset($data['mobile_image'])) {
            $mobileImage = uploadSingleImage($data['mobile_image'], 'uploads/images/categories/');
        }

        $value = [
            'category_id'       => $data['category_id'],
            'title'             => $data['title'],
            'content'           => $data['content'],
            'position'          => $data['position'],
            'image'             => isset($image) ? $image : null,
            'subcategory_id'    => $data['sub_category_id'],
            'status'            => $data['status'],
            'is_package'        => $data['is_package'] ?? 0,
            'is_bundle'         => $data['is_bundle'] ?? 0,
            'quantity'          => $data['quantity'] ?? null,
            'minimum_quantity'  => $data['minimum_quantity'] ?? null,
            'expiry'            => $data['expiry'] ?? null,
            'preferences_show'  => $data['preferences_show'] ?? 0,
        ];
        $service =  Service::create($value);

        if (isset($data['price'])) {
            foreach ($data['price'] as $key => $price) {
                ServicePrice::create([
                    'country_id' => $key,
                    'service_id' => $service->id,
                    'price'      => $price,
                ]);
            }
        }

        if (isset($data['franchise_id'])) {
            foreach ($data['franchise_id'] as $franchise_id) {
                FranchiseService::create([
                    'service_id' => $service->id,
                    'franchise_id' => $franchise_id,
                    'status' => 1

                ]);
            }
        }

        return $service;
    }

    public function update($data, $id)
    {
        if (isset($data['image'])) {
            $image       = uploadSingleImage($data['image'], 'uploads/images/categories/');
        }

        if (isset($data['mobile_image'])) {
            $mobileImage = uploadSingleImage($data['mobile_image'], 'uploads/images/categories/');
        }

        $value = [
            'category_id'      => $data['category_id'],
            // 'franchise_id'     => implode(',', $data['franchise_id']),
            'subcategory_id'   => $data['sub_category_id'],
            'title'            => $data['title'],
            'content'          => $data['content'],
            'position'         => $data['position'],
            'image'            => isset($image) ? $image : null,
            'status'           => $data['status'],
            'is_package'       => $data['is_package'] ?? 0,
            'is_bundle'        => $data['is_bundle'] ?? 0,
            'quantity'         => $data['quantity'] ?? null,
            'minimum_quantity' => $data['minimum_quantity'] ?? null,
            'expiry'           => $data['expiry'] ?? null,
            'preferences_show' => $data['preferences_show'] ?? 0,
        ];
        Service::where('id', $id)->update($value);

        $ServicePrices = ServicePrice::where('service_id', $id)->whereNotIn('country_id', $data['country_id'])->get();

        if (count($ServicePrices) >= 1) {
            foreach ($ServicePrices as $ServicePrice) {
                $ServicePrice->delete();
            }
        }

        foreach ($data['price'] as $key => $value) {
            $sp = ServicePrice::where([['service_id', $id], ['country_id', $key]])->first();
            if ($sp == null) {
                ServicePrice::create([
                    'service_id' => $id,
                    'country_id' => $key,
                    'price'      => $value
                ]);
            } else {
                $sp->update([
                    'price' => $value
                ]);
            }

            if (isset($data['franchise_id'])) {

                FranchiseService::where(['service_id' => $id])->update(['status' => 0]);

                foreach ($data['franchise_id'] as $key => $franchise_id) {
                    FranchiseService::where(['service_id' => $id, 'franchise_id' => $franchise_id])->createOrUpdate([
                        'service_id' => $id,
                        'franchise_id'      => $franchise_id,
                        'status' => 1
                    ]);
                }
            }
        }
        return true;
    }

    public function destroy($id)
    {
        return Service::destroy($id);
    }

    public function forceDelete($id)
    {
        return Service::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Service::withTrashed()->findOrFail($id)->restore();
    }
}
