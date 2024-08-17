<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
  /**
   * Show the form for editing the specified resource.
   */
  public function edit()
  {
    $email = Email::first();
    return view('admin.email.edit', compact('email'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(EmailRequest $request, $id)
  {
    Email::updateEmail($id, $request->validated());
    return redirect()->back()->withSuccess('Your have update email configration successfully.');
  }
}
