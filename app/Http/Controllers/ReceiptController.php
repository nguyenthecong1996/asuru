<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{

    protected $receipt;
    protected $customer;

    public function __construct(Receipt $receipt, Customer $customer)
    {
        $this->receipt = $receipt;
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getData(Request $request, $customerId)
    {
        $request->merge(['customerId' => $customerId]);
        return $this->receipt->getDataAjax($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($customerId)
    {
        $customer = $this->customer->with('stores')->findOrFail($customerId);
        return view('admin.invoice.create', compact('customerId', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $arrProductQuantity = array_combine($request->array_product, $request->quantity);
        // $request->validate($validate);
        $request->merge(['customerId' => $id, 'arrProductQuantity' => $arrProductQuantity]);
        // try {
            $this->receipt->saveData($request);
        //     return redirect()->route('customers.index')->with('message', 'Create a customer success');
        // } catch (\Exception $e) {
        //     return back()->withInput()->with('error', 'Fail');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
