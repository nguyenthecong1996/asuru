<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Common;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Libraries\Filterable;

class Receipt extends Model
{
    use HasFactory, Filterable;

    protected $table = 'receipts';
    protected $fillable = [
        'customer_id', 'name', 'car_number', 'date', 'status',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class,'store_receipts')->withPivot('quantity');
    }

    public function getDataAjax($request)
    {
        if($request->ajax()) {
            $data = $this->with('stores')
                    // ->filter($request)
                    ->where('customer_id', $request->customerId)
                    ->orderBy('updated_at', 'desc')->get();
                    dd($data);
            // return DataTables::of($data)
            //     ->addIndexColumn()
            //     ->addColumn('action', function ($data) {
            //         return view('admin.elements.action', [
            //             'model' => $data,
            //             'title' => 'Customer',
            //             'url_show' => route('customers.show', $data->id),
            //             'url_edit' => route('customers.edit', $data->id),
            //             'url_destroy' => route('customers.destroy', $data->id)
            //         ]);
            //     })
            //     ->editColumn('warehouse', function($data){
            //         $url = route('customers.warehouse.index', $data->id);
            //         return '<a href="' . $url . '"  target="_blank">' . "Warehouse" . '</a>';
            //     })
            //     ->rawColumns(['action', 'company_name', 'address', 'company_phone','email','warehouse'])
            //     ->make(true);
        }
    }

    public function saveData($request)
    {
        // try {
            DB::beginTransaction();
                $data = [
                    'name' => Common::clearXSS($request->name),
                    'customer_id' => $request->customerId,
                    'car_number' =>  Common::clearXSS($request->car_number),
                    'date' => $request->date,
                    "status" => $request->status
                ]; 
                $saveReceipt = $this->create($data);
                $arrayStoreReceipt = [];
                foreach($request->arrProductQuantity as $storeId => $quantity) {
                    $arrayStoreReceipt[$storeId] = ['quantity' => $quantity];
                }
                $saveReceipt->stores()->attach($arrayStoreReceipt);
            DB::commit();
            return true;

    }
}
