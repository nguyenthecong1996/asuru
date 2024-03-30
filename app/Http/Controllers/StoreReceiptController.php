<?php

namespace App\Http\Controllers;

use App\Models\StoreReceipt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreReceiptController extends Controller
{
    protected $storeReceipt;

    public function __construct(StoreReceipt $storeReceipt)
    {
        $this->storeReceipt = $storeReceipt;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getDataDetailInvoice(Request $request, $customerId, $invoiceId)
    {
        $request->merge(['customerId' => $customerId, 'invoiceId' => $invoiceId]);
        return $this->storeReceipt->getDataDetailInvoiceAjax($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreReceipt $storeReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreReceipt $storeReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreReceipt $storeReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreReceipt $storeReceipt)
    {
        //
    }
}
