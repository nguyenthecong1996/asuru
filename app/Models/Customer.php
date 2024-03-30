<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Filterable;
use Yajra\DataTables\Facades\DataTables;
use App\Libraries\Common;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'company_name', 'address', 'company_phone', 'email', 'customer_name', 'customer_phone','address', 'post_code'
    ];

    public function stores(){
        return $this->hasMany(Store::class);
    }

    public function invocies()
    {
        return $this->hasMany(Receipt::class);
    }


    public function getDataAjax($request)
    {
        if($request->ajax()) {
            $data = $this->filter($request)->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.elements.action', [
                        'model' => $data,
                        'title' => 'Customer',
                        'url_edit' => route('customers.edit', $data->id),
                        'url_destroy' => route('customers.destroy', $data->id)
                    ]);
                })
                ->addColumn('warehouse', function($data){
                    $url = route('customers.warehouse.index', $data->id);
                    return '<a href="' . $url . '"  target="_blank">' . count($data->stores) . '</a>';
                })
                ->addColumn('invoice', function($data){
                    $url = route('customers.show', $data->id);
                    return '<a href="' . $url . '"  target="_blank">' . count($data->invocies) . '</a>';
                })
                ->rawColumns(['action', 'company_name', 'address', 'company_phone','email','warehouse', 'invoice'])
                ->make(true);
        }
    }

    public function saveData($request)
    {
        $data = [
            'company_name' => Common::clearXSS($request->company_name),
            'company_phone' => Common::clearXSS($request->company_phone),
            'customer_name' => Common::clearXSS($request->customer_name),
            'customer_phone' => Common::clearXSS($request->customer_phone),
            'email' => Common::clearXSS($request->email),
            'post_code' => Common::clearXSS($request->post_code),
            'address' => Common::clearXSS($request->address)
        ]; 

        return $this->create($data);
    }

    public function updateData($request, $id)
    {
        $new = $this->findOrFail($id);
        $data = [
            'company_name' => Common::clearXSS($request->company_name),
            'company_phone' => Common::clearXSS($request->company_phone),
            'customer_name' => Common::clearXSS($request->customer_name),
            'customer_phone' => Common::clearXSS($request->customer_phone),
            'email' => Common::clearXSS($request->email),
            'post_code' => Common::clearXSS($request->post_code),
            'address' => Common::clearXSS($request->address)
        ];
        return $new->update($data);
    }
}
