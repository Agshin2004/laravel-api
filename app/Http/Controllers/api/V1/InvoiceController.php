<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Filters\V1\InvoicesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1InvoiceResource;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\V1InvoiceCollection;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): V1InvoiceCollection
    {
        $filter = new InvoicesFilter();
        $filterItems = $filter->transform($request);

        // If $filterItems === null then where will be omitted because when where accepts [] it returns all 
        $invoices = Invoice::where($filterItems);
        return new V1InvoiceCollection($invoices->paginate()->appends($request->query())); // appends() adds a set of query string values to the paginator
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

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new V1InvoiceResource($invoice);
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
