<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockApartment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $sold = StockApartment::where('status', '=', 'SOLD')->get();
        $ready = StockApartment::where('status', '=', 'READY')->get();
        $onprocess = StockApartment::where('status', '=', 'ONPROCESS')->get();
        $price = StockApartment::where('deleted_at', '=', NULL)->where('status', '=', 'SOLD')->sum('price');


        $data = [];
        $data['onprocess'] = $onprocess->count();
        $data['ready'] = $ready->count();
        $data['sold'] = $sold->count();
        $data['price'] = number_format($price,2,',','.');
        $object = (object)$data;
        return view('pages.admin.dashboard')->with('object',$object);
    }
}
