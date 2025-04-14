<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $allowedParams = [];

    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '=>',
        'ne' => '!='
    ];

    public function transform(Request $request)
    {
        $eloQuery = []; // array to be passed to eloquent

        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param); // Retrieve a query string item from the request.
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}