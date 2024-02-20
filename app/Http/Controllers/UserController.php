<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function login()
    {
        // ["email" => "test@test.com", "password" => "123123123"]
        $val = \Validator::make(\request()->all(), [
            'email' => 'string|email|exists:users|required',
            'password' => 'string|min:8|max:20|required'
        ]);
        if ($val->fails()) return ["status" => false, "errors" => $val->errors()];

        $validated = $val->validated();
        $user = User::where(["email" => $validated["email"]])->first();

        if (\Hash::check($validated["password"], $user->password)) {
            return ["status" => true, "data" => $user->createToken('login')->plainTextToken];
        }
        return ["status" => false, "message" => "Password mismatch"];
    }

    function createCustomer()
    {
        $val = \Validator::make(\request()->all(), [
            "name" => 'string|min:4',
            "description" => 'string|min:1'
        ]);
        if ($val->fails()) return ["status" => false, "errors" => $val->errors()];

        $validated = $val->validated();
        $customer = Customer::create([
                "name" => $validated["name"],
                "description" => $validated["description"],
                "user_id" => \request()->user()->id]
        );
        return $customer;
    }
    public function listCustomers()
    {
        return \request()->user()->customers()->paginate(5);
    }
    //
}
