<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class ClearCacheController extends Controller
{
  public function clearCache()
  {
    // Clear application cache
    Artisan::call('cache:clear');

    // Clear configuration cache
    Artisan::call('config:clear');

    // Clear route cache
    Artisan::call('route:clear');

    // Clear view cache
    Artisan::call('view:clear');

    // Clear event cache
    Artisan::call('event:clear');

    // Clear optimized class loader
    Artisan::call('optimize:clear');

    Alert::success('Success', 'Cache Cleared Successfully');
    return redirect()->back();
  }
}
