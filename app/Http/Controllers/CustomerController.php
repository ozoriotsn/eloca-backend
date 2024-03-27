<?php

namespace App\Http\Controllers;


use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

/**
 * @group Customers
 * APIs for managing Customers
 */
class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with('empresaData')->orderBy('created_at', 'desc')->get();

        return new CustomerCollection($customers);
    }

    public function show(Request $request,$recnum, Customer $customer): CustomerCollection
    {
        $customers = Customer::where('codigo', $recnum)->get();
        return new CustomerCollection($customers);
    }

    public function store(CustomerStoreRequest $request): CustomerResource
    {
        $data = $request->all();
       // $customer = Customer::create($request->validated());
        $customer = Customer::create($data);
        return new CustomerResource($customer);
    }

    public function update(CustomerUpdateRequest $request,$recnum, Customer $customer): CustomerResource
    {
        $data = $request->all();
        $update = Customer::where('codigo', $recnum)->update($data);
        return new CustomerResource($customer->where('codigo', $recnum)->first());

    }

    public function destroy(Request $request,$recnum, Customer $customer): CustomerCollection
    {
        $customer = Customer::where('codigo', $recnum)->get();
        $customers = Customer::where('codigo', $recnum)->delete();

        return new CustomerCollection($customer);
    }
}
