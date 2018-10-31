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
        dump($request);die;
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
}
