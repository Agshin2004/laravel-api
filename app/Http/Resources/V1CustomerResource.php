<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\V1InvoiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class V1CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'postalCode' => $this->postal_code,
            // Only include preloaded invoices if with() or load() was used
            'invoices' => V1InvoiceResource::collection($this->whenLoaded('invoices'))
        ];
    }
}
