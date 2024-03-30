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
        return view('admin.invoice.index');
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
        $arrWeightDifferent = array_combine($request->array_product, $request->weight_different_hidden);

        // $request->validate($validate);
        $request->merge(['customerId' => $id, 'arrProductQuantity' => $arrProductQuantity, 'arrWeightDifferent' => $arrWeightDifferent]);
        try {
            $this->receipt->saveData($request);
            return redirect()->route('customers.show', $id)->with('message', 'Create a invoice success');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($customerId,  $idInvoice)
    {
        $invoice = $this->receipt->findOrFail($idInvoice);
        $customer = $invoice->customer;
        return view('admin.invoice.show', compact('invoice', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customerId,  $idInvoice)
    {
        $invoice = $this->receipt->with('stores')->findOrFail($idInvoice);
        // dd( $invoice);
        $customer = $invoice->customer;
        $listStores = $customer->stores->toArray();
        return view('admin.invoice.edit', compact('invoice', 'customer', 'listStores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$customerId,  $idInvoice)
    {

        $arrProductQuantity = array_combine($request->array_product, $request->quantity);
        $arrWeightDifferent = array_combine($request->array_product, $request->weight_different_hidden);

        // $request->validate($validate);
        $request->merge(['customerId' => $customerId, 'arrProductQuantity' => $arrProductQuantity, 'arrWeightDifferent' => $arrWeightDifferent, 'idInvoice' => $idInvoice]);

        try {
            $this->receipt->updateData($request);
            return redirect()->route('customers.show', $customerId)->with('message', 'Update a invoice success');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
