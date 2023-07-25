<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class InvoiceRepository
{
    public function get($id)
    {
        return Invoice::find($id);
    }

    public function remove($id)
    {
        return Invoice::where('id', $id)->delete();
    }

    public function create($orderId, $total)
    {
        return Invoice::create([
            'order_id' => $orderId,
            'total' => $total
        ]);
    }

    public function getAll()
    {
        return Invoice::all();
    }

    public function pagination($criteria, $fields, $perPage, $page)
    {
        return Invoice::query()
            ->when(isset($criteria['order_id']), function ($query) use ($criteria) {
                $query->where('order_id', $criteria['order_id']);
            })
            ->when(isset($criteria['total']), function ($query) use ($criteria) {
                $query->where('total', $criteria['total']);
            })
            ->when(isset($criteria['created_at']), function ($query) use ($criteria) {
                $query->where('created_at', $criteria['created_at']);
            })
            ->paginate($perPage, $fields, 'page', $page);
    }
}
