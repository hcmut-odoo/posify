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

    public function pagination($perPage, $page)
    {
        return Invoice::paginate($perPage, ['*'], 'page', $page);
    }
}
