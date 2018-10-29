<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use Illuminate\Http\Request;
use App\Models\UserAddress;

class UserAddressesController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('user_address.index', ['addresses' => $request->user()->addresses]);
    }

    //创建收获地址
    public function create()
    {
        return view('user_address.create_and_edit', ['address' => new UserAddress()]);
    }

    public function store(UserAddressRequest $request) {

    }
}
