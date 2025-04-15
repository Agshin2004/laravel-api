<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceCollection extends ResourceCollection
{
    // Overriding $collects so collection will use same format as resource
    public $collects = InvoiceResource::class;

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
