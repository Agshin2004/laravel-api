<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\V1CustomerResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class V1CustomerCollection extends ResourceCollection
{
    // Overriding $collects so collection will use same format as resource
    public $collects = V1CustomerResource::class;

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
