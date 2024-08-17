<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentHistory;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CartRepositoryInterface;

class OrderController extends Controller
{

  protected $cartRepository;

  public function __construct(CartRepositoryInterface $cartRepository)
  {
    $this->cartRepository = $cartRepository;
  }

  public function index()
  {
    $orders = Order::latest('id')->paginate(10);
    $payments = PaymentMethod::active()->orderByRaw('id')->get();
    return view('admin.order.index', compact('orders', 'payments'));
  }
  public function order(Request $request)
  {
    $this->cartRepository->orderProduct($request->all());
    return response()->json(['success' => true, 'redirect_url' => route('admin.order.index')]);
  }


  public function paymentHistory(string $id)
  {
    $paymentHistories = PaymentHistory::with('user')->where('order_id', $id)->latest('id')->get();
    return response()->json($paymentHistories);
  }

  public function paymentAdd(string $id, OrderRequest $request)
  {
    $newPayment = new PaymentHistory();
    $newPayment->user_id = Auth::id();
    $newPayment->customer_id = 10;
    $newPayment->order_id = $id;
    $newPayment->total_amount = $request->total_amount;
    $newPayment->payment_amount = $request->paying_amount;
    $newPayment->due_amount = $request->due_amount;
    $newPayment->payment_type = $request->payment_type;
    $newPayment->payment_note = $request->payment_note;
    $newPayment->sale_note = $request->sale_note;
    $newPayment->save();

    $orderPaymentUpdate = Order::where('id', $id)->first();
    $orderPaymentUpdate->user_id = Auth::id();
    $orderPaymentUpdate->total_amount = $request->total_amount;
    $orderPaymentUpdate->payment_amount = $request->paying_amount;
    $orderPaymentUpdate->due_amount = $request->due_amount;
    $orderPaymentUpdate->payment_type = $request->payment_type;
    $orderPaymentUpdate->payment_note = $request->payment_note;
    $orderPaymentUpdate->sale_note = $request->sale_note;
    $orderPaymentUpdate->update();
  }


  public function paymentDestroy(string $id)
  {
    PaymentHistory::findOrFail($id)->delete();
  }

  public function view(string $id)
  {
    $order =  Order::with('user')->with('payment')->findOrFail($id);
    return view('admin.order.view', compact('order'));
  }
  public function destroy(string $id)
  {
    Order::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Order deleted successfully.');
  }
}
