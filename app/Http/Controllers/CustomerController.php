<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt;
class CustomerController extends Controller
{
    protected $customer;
    protected $receipt;

    public function __construct(Customer $customer, Receipt $receipt)
    {
        $this->customer = $customer;
        $this->receipt = $receipt;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getData(Request $request)
    {
        return $this->customer->getDataAjax($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            // 'title' => 'required|max:100|string',
            // 'image_url' => 'required|image|mimes:jpeg,png,jpg,svg|max:5120',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers']
        ];

        $request->validate($validate);
        try {
            $this->customer->saveData($request);
            return redirect()->route('customers.index')->with('message', 'Create a customer success');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = $this->customer->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = $this->customer->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = [
            'email'=> 'required|email|unique:customers,email,' .$id,
        ];
        $request->validate($validate);
        try {
            $this->customer->updateData($request, $id);
            return redirect()->route('customers.index')->with('message', 'Update customer success');
        } catch(\Exception $exception) {
            return back()->withInput()->with('error', 'Update fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->customer->find($id)->delete();
            return response()->json(['message' => trans('common.detele_success', ['name' => trans('common.advertisement.name')])]);
        } catch (\Exception $e) {
            return response()->json(['error' =>  trans('common.detele_failed', ['name' => trans('common.advertisement.name')])]);
        }
    }
}
