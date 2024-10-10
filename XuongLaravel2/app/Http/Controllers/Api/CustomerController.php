<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $term = request('term', null);

        $data = Customer::latest('id')
            ->when($term, function ($query, $term) {
                $query->whereAny([
                    'name',
                    'email',
                    'phone',
                    'address',
                ], 'like', "%$term%");
            })

            ->paginate(5);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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

            $customer = Customer::query()->create($data);

            return response()->json($customer, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'lỗi hệ thống',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
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
    public function update(Request $request, Customer $customer)
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
            return response()->json($validator->errors(), 422);
        }


        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customers', 'public');
        }

        $imagePath = $customer->image;

        $customer->update($data);

        if ($request->hasFile('image')) {
            $customer->image = $imagePath;
        }

        if ($request->hasFile('image') && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        $customer->delete();

        if (Storage::exists($customer->image)) {
            Storage::delete($customer->image);
        }

        return response()->json([], 204);
    }
}
