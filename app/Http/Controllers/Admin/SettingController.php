<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{

  public function message(Request $request)
  {
    return 'ok';
  }



  public function users()
  {
    $users = User::all();
    return response()->json(['users' => $users]);
  }


  public function userMessage(Request $request)
  {
    return response()->json($request->all());
  }
}
