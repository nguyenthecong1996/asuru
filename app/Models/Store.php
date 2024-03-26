<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Common;
use Yajra\DataTables\Facades\DataTables;
use App\Libraries\Filterable;

class Store extends Model
{
    use HasFactory, Filterable;

    protected $table = 'stores';
    protected $fillable = [
        'name', 'customer_id', 'quantity', 'price'
    ];

    public function getDataAjax($request)
    {
        if($request->ajax()) {
            $data = $this->filter($request)->where('customer_id', $request->customerId)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.elements.action', [
                        'model' => $data,
                        'title' => 'Customer',
                        'url_show' => route('customers.show', $data->id),
                        'url_edit' => route('customers.edit', $data->id),
                        'url_destroy' => route('customers.destroy', $data->id)
                    ]);
                })
                ->editColumn('total_price', function($data){
                    return '1';
                })
                ->rawColumns(['action', 'name', 'quantity', 'price','total_price'])
                ->make(true);
        }
    }

    public function saveData($request)
    {
        $data = [
            'name' => Common::clearXSS($request->name),
            'customer_id' => $request->customerId,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]; 

        return $this->create($data);
    }
}
