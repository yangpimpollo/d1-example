<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:customers,dni|digits:8',
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        return Customer::create($request->all());
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'dni' => 'sometimes|required|unique:customers,dni|digits:8',
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
        ]);

        $customer->update($request->all());
        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 204);
    }
}
