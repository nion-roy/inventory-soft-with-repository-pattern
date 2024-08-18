<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderController extends Controller
{

  protected $orderRepository;

  public function __construct(OrderRepositoryInterface $orderRepository)
  {
    $this->orderRepository = $orderRepository;
  }

  public function index()
  {
    $orders = $this->orderRepository->getAll();
    $payments = PaymentMethod::active()->orderByRaw('id')->get();
    return view('admin.order.index', compact('orders', 'payments'));
  }

  public function order(Request $request)
  {
    $this->orderRepository->orderProduct($request->all());
    return response()->json(['success' => true, 'redirect_url' => route('admin.order.index')]);
  }

  public function view(string $id)
  {
    $order = $this->orderRepository->show($id);
    return view('admin.order.view', compact('order'));
  }

  public function destroy(string $id)
  {
    $this->orderRepository->destroy($id);
    return redirect()->back()->with('success', 'Order deleted successfully.');
  }

  public function paymentAdd(string $id, OrderRequest $request)
  {
    $this->orderRepository->newPaymentAdd($id, $request->validated());
  }

  public function paymentHistory(string $id)
  {
    $paymentHistories = $this->orderRepository->paymentHistroyShow($id);
    $data = view('admin.order.__payment_history', compact('paymentHistories'))->render();
    return response()->json(['paymentHistories' => $data]);
  }

  public function singlePaymentHistory(string $id)
  {
    $historyLatest = $this->orderRepository->singlePaymentHistory($id);
    return response()->json(['historyLatest' => $historyLatest]);
  }

  public function paymentDestroy(string $id)
  {
    $this->orderRepository->paymentHistoryDestroy($id);
  }
}
