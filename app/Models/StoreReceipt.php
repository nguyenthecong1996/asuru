<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use App\Libraries\Filterable;
class StoreReceipt extends Model
{
    protected $table = 'store_receipts';

    use HasFactory, Filterable;

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getDataDetailInvoiceAjax($request)
    {
        if($request->ajax()) {
            $data = $this->with('store')
            ->filter($request)
            ->where('receipt_id', $request->invoiceId)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($data){
                    return $data->store->name;
               })
                ->addColumn('before_weight', function($data){
                     return $data->store->weight;
                })
                ->addColumn('after_weight', function($data){
                    return $data->store->weight - $data->weight_different;
                })
                ->addColumn('price', function($data){
                    return $data->store->price;
                })
                ->addColumn('total_price', function($data){
                    return $data->weight_different*$data->store->price;
                })
                ->rawColumns(['total_price', 'name', 'before_weight', 'after_weight', 'price', 'weight_different'])
                ->make(true);
        }
    }
}
