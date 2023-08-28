<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\Models\PackageService;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PackageRepository implements PackageRepositoryInterface
{
    public function get()
    {
        return Package::latest()->get();
    }

    public function find($id)
    {
        return Package::findOrFail($id);
    }

    public function find_package_by_id($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Package::where('id', $id);

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

    public function find_package_services($package_id, array $services)
    {
        // foreach ($services as $service) {
        //     $service_id[] = $service['service_id'];
        //     PackageService::updateOrCreate(['package_id' => $service['package_id']], $service);
        // }
        // return PackageService::where('package_id', $package_id)->whereIn('service_id', $service_id)->get();
    }

    public function store(array $data)
    {
        // $services = $data['services'];
        $value = [
            'name'              => $data['name'],
            'price'             => $data['price'],
            'type'              => $data['type'] ?? 0,
            'worth'             => $data['worth'],
            'worth_type'        => $data['worth_type'],
            'short_description' => $data['short_description'],
            'description'       => $data['description'],
            'trial_period'      => $data['trial_period'],
            'tag_line'          => $data['tag_line'],
            'popular'           => $data['popular'] ?? 0,
            'created_by'        => Auth::user()->id,
            'status'            => $data['status'] ?? 0,
        ];
        $package = Package::create($value);

        // // SERVICES
        // $value = [];
        // foreach ($services as $service) {
        //     if (isset($service['available'])) {
        //         $value[] = [
        //             'package_id' => $package->id,
        //             'service_id' => $service['available'],
        //             'price'      => $service['price'],
        //             'unit'       => $service['unit'],
        //             'quantity'   => $service['quantity'],
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ];
        //     }
        // }
        // // PackageService::insert($value);

        return $package;
    }

    public function update(array $data, $id)
    {
        $value = [
            'name'              => $data['name'],
            'price'             => $data['price'],
            'type'              => $data['type'] ?? 0,
            'worth'             => $data['worth'],
            'worth_type'        => $data['worth_type'],
            'short_description' => $data['short_description'],
            'description'       => $data['description'],
            'trial_period'      => $data['trial_period'],
            'tag_line'          => $data['tag_line'],
            'popular'           => $data['popular'] ?? 0,
            'updated_by'        => Auth::user()->id,
            'status'            => $data['status'] ?? 0,
        ];
        return $this->find($id)->update($value);

        // // SERVICES
        // $services = $data['services'];
        // $value = [];
        // foreach ($services as $service) {
        //     if (isset($service['available'])) {
        //         $value[] = [
        //             'package_id' => $id,
        //             'service_id' => $service['available'],
        //             'price'      => $service['price'],
        //             'unit'       => $service['unit'],
        //             'quantity'   => $service['quantity'],
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ];
        //     }
        // }
        // // return $value;
        // $package_services = $this->find_package_services($id, $value);
        // return $package_services;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
