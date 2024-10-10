<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::query()->latest('id')->paginate(5);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name => required|max:255',
            'email => required|email|unique:customers',
            'phone => required|unique:customers',
            'address => nullable',
            'is_active => required|boolean',
            'image => required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('customers', 'public');
            }

            Customer::query()->create($data);

            return redirect()->route('customers.index')->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', 'fails');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            if (Storage::exists($customer->image)) {
                Storage::delete($customer->image);
            }

            return back()->with('success', 'success');
        } catch (\Throwable $th) {
            return back()->with('success', 'fails');
        }
    }
}
