<?php

namespace App\Repositories\Interfaces;

interface PreferenceRepositoryInterface
{
    public function all();

    public function get($where);

    public function getPrefrences();

    public function paginate($page);

    public function store($input);

    public function find($id);

    public function update($id, $input);

    public function destroy($id);

    public function forceDelete($id);

    public function recover($id);
}
