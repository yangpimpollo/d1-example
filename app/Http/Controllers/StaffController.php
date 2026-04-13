<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{

    public function index() { return Staff::all(); }


    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        
        return Staff::create($request->all());
    }


    public function show(Staff $staff) { return $staff; }


    public function update(Request $request, Staff $staff)
    {
        $staff->update($request->all());
        return $staff;
    }


    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(['message' => 'staff eliminado exitosamente'], 204);
    }
}
