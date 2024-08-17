<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
  public function nion_index()
  {
    $products = Product::latest()->take(4)->get();
    $customers = Customer::latest()->take(6)->get();
    $customer = Customer::count();
    $product = Product::count();
    $paymentMethoad = PaymentMethod::count();
    $saleInvoice = Order::count();
    $saleAmount = Order::sum('total_amount');
    $saleDue = Order::sum('total_amount') - Order::sum('payment_amount');
    return view('admin.dashboard', compact('products', 'customers', 'customer', 'product', 'paymentMethoad', 'saleInvoice', 'saleAmount', 'saleDue'));
  }

  public function nion_logout(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Your account logout successfull.');
  }
}
