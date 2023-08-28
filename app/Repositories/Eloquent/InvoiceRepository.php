<?php
namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function all()
    {
        return Invoice::latest()->get();
    }

    public function getInvoiceById($id, array $whereClauses = [], array $withClauses = [])
    {
        $query = Invoice::where('id', $id);

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

    public function getActiveInvoices()
    {
        return Invoice::active()->get();
    }

    public function getPendingInvoices($member_id = null)
    {
        $query = Invoice::pending()->latest();
        if ($member_id != null) {
            $query->where('member_id', $member_id);
        }
        return $query->get();
    }

    public function getCancelledInvoices($member_id = null)
    {
        $query = Invoice::cancelled()->latest();
        if ($member_id != null) {
            $query->where('member_id', $member_id);
        }
        return $query->get();
    }

    public function getProcessedInvoices($member_id = null)
    {
        $query = Invoice::processing()->latest();
        if ($member_id != null) {
            $query->where('member_id', $member_id);
        }
        return $query->get();
    }

    public function getCompletedInvoices($member_id = null)
    {

        $query = Invoice::completed()->latest();
        if ($member_id != null) {
            $query->where('member_id', $member_id);
        }
        return $query->get();
    }

    public function getSumCount($member_id = null)
    {
        $grand_total = Invoice::whereNotIn('payment_status', ['0', '2'])->sum('grand_total');
        $discount_total = Invoice::whereNotIn('payment_status', ['0', '2'])->sum('discount_total');
        $service_charge_total = Invoice::whereNotIn('payment_status', ['0', '2'])->sum('service_charges');
        $service_total = Invoice::whereNotIn('payment_status', ['0', '2'])->sum('services_total');
        $preferences_total = Invoice::whereNotIn('payment_status', ['0', '2'])->sum('preference_total');
        $net_revenue = $grand_total + $preferences_total - $service_charge_total - $discount_total;
        $count = Invoice::whereNotIn('payment_status', ['0', '2'])->count();
        return [
            'total_sum' => $grand_total,
            'count_invoice' => $count,
            'discount_total' => $discount_total,
            'service_charge_total' => $service_charge_total,
            'service_total' => $service_total,
            'preferences_total' => $preferences_total,
            'net_revenue' => $net_revenue,
        ];
    }

    public function get($id, $whereClauses = [])
    {
        $query = Invoice::where('id', $id);
        if (count($whereClauses) > 0) {
            foreach ($whereClauses as $column => $value) {
                $query->where($column, $value);
            }
        }

        return $query->first();
    }

    public function paginate($page)
    {
        $page = isset($page) ? $page : 10;
        return Invoice::latest()->paginate($page);
    }

    public function store($input)
    {
        $data = [];
        return Invoice::create($data);
    }

    public function find($id)
    {
        return Invoice::find($id);
    }

    public function update($input, $id)
    {
        $data = [];
        return Invoice::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return Invoice::destroy($id);
    }

    public function delete($id)
    {
        return Invoice::delete($id);
    }

    public function forceDelete($id)
    {
        return Invoice::findOrFail($id)->forceDelete();
    }

    public function recover($id)
    {
        return Invoice::withTrashed()->findOrFail($id)->restore();
    }
}
