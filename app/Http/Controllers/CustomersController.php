<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
  public function app() {
    return view('app');
  }
  
  public function index()
  {
    try {
      $customers = Customer::all();
      $res['response'] = $customers ? 'success' : 'failed';
      $res['result'] = $customers;
    } catch (\Throwable $e) {
      $res['response'] = 'error';
    }
    $res['message'] = 'List customers data';
    return General::resJson($res);
  }
  
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'   => 'required',
      'email' => 'required',
      'password' => 'required',
    ]);
  
    if ($validator->fails()) {
      $res['response'] = 'error';
      $res['message'] = 'Missing required params';
      return General::resJson($res);
    }
    
    try {
      $customer = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender' => !empty($request->gender) ? $request->gender : null,
        'is_married' => !empty($request->is_married) ? $request->is_married : 0,
        'address' => !empty($request->address) ? $request->address : null
      ]);
      $res['response'] = $customer ? 'success' : 'failed';
      $res['result'] = $customer;
      $res['message'] = "Store customer data";
    } catch (\Throwable $e) {
      $res['response'] = 'error';
      $res['message'] = $e->getMessage();
    }

    return General::resJson($res);
  }
  
  public function getCustomer($id)
  {
    try {
      $customer = Customer::find($id);
      $res['response'] = $customer ? 'success' : 'failed';
      $res['result'] = $customer;
    } catch (\Throwable $e) {
      $res['response'] = 'error';
    }
    $res['message'] = 'Get customers data';
    return General::resJson($res);
  }
  
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name'   => 'required',
      'email' => 'required'
    ]);
  
    if ($validator->fails()) {
      $res['response'] = 'error';
      $res['message'] = 'Missing required params';
      return General::resJson($res);
    }
  
    try {
      $customer = Customer::find($id);
      $customer->name = $request->name;
      $customer->email = $request->email;
      if (!empty($request->password)) {
        $customer->password = Hash::make($request->password);
      }
      $customer->gender = !empty($request->gender) ? $request->gender : null;
      $customer->is_married = !empty($request->is_married) ? $request->is_married : 0;
      $customer->address = !empty($request->address) ? $request->address : null;
      $res['response'] = $customer->save() ? 'success' : 'failed';
      $res['result'] = $customer;
      $res['message'] = "Update customer data";
    } catch (\Throwable $e) {
      $res['response'] = 'error';
      $res['message'] = $e->getMessage();
    }
  
    return General::resJson($res);
  }
  
  public function delete($id)
  {
    try {
      $customer = Customer::find($id);
      $res['response'] = $customer->delete() ? 'success' : 'failed';
      $res['result'] = $customer;
      $res['message'] = "Delete customer data";
    } catch (\Throwable $e) {
      $res['response'] = 'error';
      $res['message'] = $e->getMessage();
    }
    return General::resJson($res);
  }
}
