<?php

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function all();

    public function getInvoiceById($id, array $whereClauses = [], array $withClauses = []);

    public function get($id, $whereClauses = []);

    public function getActiveInvoices();

    public function getPendingInvoices($member_id = null);

    public function getCancelledInvoices($member_id = null);

    public function getProcessedInvoices($member_id = null);

    public function getCompletedInvoices($member_id = null);

    public function getSumCount($member_id = null);

    public function paginate($page);

    public function store($input);

    public function find($id);

    public function update($input, $id);

    public function destroy($id);

    public function delete($id);

    public function forceDelete($id);

    public function recover($id);
}
