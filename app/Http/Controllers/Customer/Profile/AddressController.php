<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('customer.profile.my-addresses', compact('provinces', 'cities'));
    }
}
