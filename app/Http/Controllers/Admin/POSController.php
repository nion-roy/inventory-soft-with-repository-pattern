<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tax;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{

  protected $cartRepository;

  public function __construct(CartRepositoryInterface $cartRepository)
  {
    $this->cartRepository = $cartRepository;
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $products = Product::active()->latest()->get();
    $categories = Category::active()->latest('id')->get();
    $brands = Brand::active()->latest('id')->get();
    $payments = PaymentMethod::active()->orderBy('id')->get();
    $taxes = Tax::active()->orderBy('id')->get();
    $customers = Customer::active()->latest('id')->get();

    return view('admin.pos.index', compact('customers', 'products', 'categories', 'brands', 'payments', 'taxes'));
  }


  public function filterProducts(Request $request)
  {
    $products = Product::query();

    if ($request->search) {
      $products = $products->where('product_name', 'like', '%' . $request->search . '%');
    }

    if ($request->category) {
      $products = $products->where('category_id', $request->category);
    }

    if ($request->brand) {
      $products = $products->where('brand_id', $request->brand);
    }

    $products = $products->latest()->get();

    return view('admin.pos.render_product', compact('products'))->render();
  }


  public function addToCart(Request $request)
  {
    $this->cartRepository->create($request->all());
    return response()->json(['success' => true]);
  }

  public function productToCart()
  {
    $carts = Cart::with('product')->where('user_id', Auth::id())->latest('id')->get();

    $subTotal = 0;
    $quantity = 0;
    $total = 0;
    $tax = 0;
    $discount = 0;
    $shipping = 0;
    $totalResult = 0;
    foreach ($carts as $item) {
      $subTotal += ($item->price * $item->quantity);
      $quantity += $item->quantity;
      $tax += $item->tax * $item->quantity;
      $discount = $item->discount_price;
      $shipping = $item->shipping_charge;
      $totalResult += ($item->price * $item->quantity);
      $total = ($totalResult + $tax + $shipping) - $discount;
    }

    $view = view('admin.pos.render_cart', compact('carts'))->render();
    return response()->json(['html' => $view, 'subTotal' => $subTotal, 'quantity' => $quantity, 'total' => $total, 'tax' => $tax, 'discount' => $discount, 'shipping' => $shipping]);
  }


  public function removeToCart(String $id)
  {
    $this->cartRepository->destroy($id);
    return response()->json(['success' => true]);
  }

  public function incrementToCart(String $id)
  {
    $this->cartRepository->incrementQuantity($id);
    return response()->json(['success' => true]);
  }

  public function decrementToCart(String $id)
  {
    $this->cartRepository->decrementQuantity($id);
    return response()->json(['success' => true]);
  }

  public function manualToCart(Request $request, String $id)
  {
    $quantity = $request->quantity;
    $this->cartRepository->manualQuantity($id, ['quantity' => $quantity]); // Wrap the quantity in an array
    return response()->json(['success' => true]);
  }



  public function resetToCart()
  {
    Cart::truncate();
    return response()->json(['successMsg' => 'Cart reset successfully']);
  }

  public function taxToCart(Request $request)
  {
    $carts = Cart::where('user_id', Auth::id())->get();
    foreach ($carts as $cart) {
      $cart->tax = calculateTaxFromPrice($cart->price, $request->taxValue);
      $cart->save();
    }
    return response()->json(['successMsg' => 'Tax add to product successfully']);
  }


  public function discountToCart(Request $request)
  {
    $carts = Cart::where('user_id', Auth::id())->get();
    $total = 0;

    // Calculate the total price by summing up the price multiplied by quantity for each cart item
    foreach ($carts as $cart) {
      $total += $cart->price * $cart->quantity;
    }
    // Iterate through each cart item to apply the discount
    foreach ($carts as $cart) {
      $cart->discount_type = $request->discountType;
      if ($request->discountType == 'fixed') {
        $cart->discount_price = $request->discountValue;
      } elseif ($request->discountType == 'percentage') {
        $cart->discount_price = ($request->discountValue / 100) * $total;
      } else {
        $cart->discount_type = 'no discount';
        $cart->discount_price = 0;
      }
      $cart->save();
    }

    return response()->json(['successMsg' => 'Discount price added successfully']);
  }



  public function shippingToCart(Request $request)
  {
    $carts = Cart::where('user_id', Auth::id())->get();

    foreach ($carts as $cart) {
      $cart->shipping_type = $request->shippingType;
      if ($request->shippingType == 'inside' || $request->shippingType == 'outside') {
        $cart->shipping_charge = $request->shippingValue;
      } else {
        $cart->shipping_type = 'no shipping';
        $cart->shipping_charge = 0;
      }
      $cart->save();
    }
    return response()->json(['successMsg' => 'Shipping charge add to successfully']);
  }
}
