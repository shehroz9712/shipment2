<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface
{
    public function sendMails();

    public function all();

    public function getCartsWith($where = [], $with =[]);

    public function getCartWith($id, $where = [], $with =[]);

    public function paginate($page);

    public function store($data);

    public function find($id);

    public function update($data, $id);

    public function delete($id);

    public function recover($id);
}
