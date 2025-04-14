<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter
{
    protected $allowedParams = [
        'name' => ['eq', 'ne'],
        'type' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'address' => ['eq', 'ne'],
        'city' => ['eq', 'ne'],
        'country' => ['eq', 'ne'],
        'postalCode' => ['eq', 'gt', 'lt', 'ne'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '=>',
        'ne' => '!='
    ];
}