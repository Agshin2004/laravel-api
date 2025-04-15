<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Requests\BulkStoreInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Filters\V1\InvoicesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): InvoiceCollection
    {
        $filter = new InvoicesFilter();
        $filterItems = $filter->transform($request);

        // If $filterItems === null then where will be omitted because when where accepts [] it returns all 
        $invoices = Invoice::where($filterItems);
        return new InvoiceCollection($invoices->paginate()->appends($request->query())); // appends() adds a set of query string values to the paginator
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        // Create a collection from the given value
        $bulk = collect($request->all())->map(function ($arr, $key) {
        // Merge data from request and add two additional created_at and updated_at fields
            return array_merge(
                Arr::except($arr, ['customerId', 'billedDate', 'paidDate']), // Get all of the given array except for a specified array of keys
                ['created_at' => now(), 'updated_at' => now()]
            );
        });

        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
