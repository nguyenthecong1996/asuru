<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($customerId)
    {
        return view('admin.warehouse.index', compact('customerId'));
    }

    public function getData(Request $request, $customerId)
    {
        $request->merge(['customerId' => $customerId]);
        return $this->store->getDataAjax($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($customerId)
    {
        return view('admin.warehouse.create', compact('customerId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $customerId)
    {
        $validate = [
            // 'title' => 'required|max:100|string',
            // 'image_url' => 'required|image|mimes:jpeg,png,jpg,svg|max:5120',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers']
        ];
        // $request->validate($validate);
        $request->merge(['customerId' => $customerId]);
        try {
            $this->store->saveData($request);
            return redirect()->route('customers.index')->with('message', 'Create a customer success');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
