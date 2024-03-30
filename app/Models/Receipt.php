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
        return $this->belongsToMany(Store::class,'store_receipts')->withPivot('quantity', 'weight_different');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getDataAjax($request)
    {
        if($request->ajax()) {
            $data = $this->with('stores')
                    ->filter($request)
                    ->where('customer_id', $request->customerId)
                    ->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.elements.action', [
                        'model' => $data,
                        'title' => 'Customer',
                        'url_edit' => route('customers.invoice.edit', [$data->customer->id, $data->id]),
                        'url_destroy' => route('customers.invoice.destroy', $data->id)
                    ]);
                })
                ->addColumn('total_price', function($data){
                    $totalQuantity =$data->stores->sum(function ($item) {
                        return $item->pivot->weight_different*$item->price;
                    });
                    return '<a href="'.route('customers.invoice.show', [$data->customer->id, $data['id']]).'">'. $totalQuantity .'</a>';
                })
                ->rawColumns(['action', 'total_price', 'name'])
                ->make(true);
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
                    $arrayStoreReceipt[$storeId] = [
                        'quantity' => $quantity,
                        'weight_different' => $request->arrWeightDifferent[$storeId]
                    ];
                }
                $saveReceipt->stores()->attach($arrayStoreReceipt);
            DB::commit();
            return true;

    }


    public function updateData($request)
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
                $uodateReceipt = $this->findOrFail($request->idInvoice);

                $arrayStoreReceipt = [];
                foreach($request->arrProductQuantity as $storeId => $quantity) {
                    $arrayStoreReceipt[$storeId] = [
                        'quantity' => $quantity,
                        'weight_different' => $request->arrWeightDifferent[$storeId]
                    ];
                }
                $uodateReceipt->stores()->sync($arrayStoreReceipt);
                $uodateReceipt->update($data);
            DB::commit();
            return true;

    }
}
