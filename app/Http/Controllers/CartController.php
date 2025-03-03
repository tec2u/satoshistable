<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Package;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::with('package')->whereHas('package', function ($query) {
            $query->where('type', '<>', 'activator');
        })->where('user_id', auth()->user()->id)->get();

        $cartActivatorItems = Cart::with('package')->whereHas('package', function ($query) {
            $query->where('type', 'activator');
        })->where('user_id', auth()->user()->id)->get();

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->price;
        }
        foreach ($cartActivatorItems as $item) {
            $total += $item->price;
        }
        // return response()->json($cartItems);
        return view('cart.index', compact('cartItems','cartActivatorItems', 'total'));
    }
    public function store(Request $request)
    {

        $packageActivator = Package::find($request->packageID);

        $activatorPackageData = [
            'package_id' => $packageActivator->id,
            'user_id' => auth()->user()->id,
            'price' => $packageActivator->price
        ];

        Cart::create($activatorPackageData);

        $othersPackages = Package::whereIn('id', json_decode($request->othersPackagesIDs))->get();

        foreach ($othersPackages as $otherPackage) {
            $otherPackageData = [
                'package_id' => $otherPackage->id,
                'user_id' => auth()->user()->id,
                'price' => $otherPackage->price
            ];

            Cart::create($otherPackageData);
        }

        return redirect()->route('cart.index');
    }
    public function update() {}
    public function destroy($id) {
        Cart::where('id', $id)->delete();
        return redirect()->route('cart.index');
    }
}
