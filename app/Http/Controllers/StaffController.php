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
        $request->validate([ 
            'dni' => 'required|unique:staffs,dni|digits:8',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'store_id' => 'required|exists:stores,id' // valida existencia de store_id en stores
        ]);  
        $request->merge(['password' => Hash::make($request->password)]);
        
        return Staff::create($request->all());
    }


    public function show(Staff $staff) { return $staff; }


    public function update(Request $request, Staff $staff)
    {
        $request->validate([ 
            'dni' => 'sometimes|required|unique:staffs,dni|digits:8',
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'password' => 'sometimes|required',
            'store_id' => 'sometimes|exists:stores,id' // sometimes permite que store_id sea opcional, pero si se proporciona, debe existir en stores
        ]);  
        if($request->has('password')) { $request->merge(['password' => Hash::make($request->password)]); }  // si no se hashea uno vacio
        $staff->update($request->all());
        return $staff;
    }


    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(['message' => 'staff eliminado exitosamente'], 200);
    }
}
