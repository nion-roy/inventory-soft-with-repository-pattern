<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();
    $request->session()->regenerate();
    $user = Auth::user();

    try {
      $expireDate = Carbon::createFromFormat('d-m-Y', $user->expire);

      if ($expireDate >= Carbon::now()) {
        if ($user->status == 1) {
          Alert::success("Success", "Your Account Login Successfull.");
          return redirect()->route('admin.dashboard');
        } elseif ($user->status == 2) {
          Auth::logout();
          return redirect()->back()->with(['warning' => 'Your account is pending.'])->withInput($request->only('email'));
        } elseif ($user->status == 3) {
          Auth::logout();
          return redirect()->back()->with(['warning' => 'Your account is suspended.'])->withInput($request->only('email'));
        } elseif ($user->status == 4) {
          Auth::logout();
          return redirect()->back()->with(['error' => 'Your account is blocked.'])->withInput($request->only('email'));
        } else {
          Auth::logout();
          return redirect()->back()->with(['error' => 'Invalid account status'])->withInput($request->only('email'));
        }
      } else {
        Auth::logout();
        return redirect()->back()->with(['warning' => 'Your account has expired.'])->withInput($request->only('email'));
      }
    } catch (\Exception $e) {
      // Handle exceptions here, for example log the error
      return redirect()->route('login')->with('error', 'An error occurred. Please try again later.' . $e)->withInput($request->only('email'));
    }
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
