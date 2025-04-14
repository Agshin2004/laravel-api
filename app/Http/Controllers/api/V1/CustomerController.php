<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1CustomerCollection;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): V1CustomerCollection
    {
        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request); // -> [['column', 'operator', 'value']]
        $includeInvoices = $request->query('includeInvoices');

        // If $filterItems === null then where will be omitted because when where accepts [] it returns all 
        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices'); // invoices is method on Customer model (acts like field)
        }

        return new V1CustomerCollection($customers->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        // Create resource and return json to the client
        return new V1CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): V1CustomerResource
    {
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices) {
            // Only load relationship if haven't been loaded.
            return new V1CustomerResource($customer->loadMissing('invoices'));
        }

        return new V1CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customerId = $customer->id;
        $customer->update($request->all());

        return new V1CustomerResource(Customer::where('id', $customerId)->first());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
