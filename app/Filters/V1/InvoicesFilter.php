<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter
{
    protected $allowedParams = [
        'customerId' => ['eq', 'ne'],
        'amount' => ['eq', 'gt', 'gte', 'lt', 'lte', 'ne'],
        'status' => ['eq', 'ne'],
        'billedDate' => ['eq', 'ne'],
        'paidDate' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'postal_code',
        'paidDate' => 'paid_date'
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