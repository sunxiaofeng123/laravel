<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\User;
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
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function edit(UserAddress $user_address)
    {
        return view('user_address.create_and_edit', ['address' => $user_address]);
    }

    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }
}
