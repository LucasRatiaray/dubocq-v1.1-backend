<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilter;

class ProjectFilter extends QueryFilter
{
    public function type($value) {
        return $this->builder->whereIn('type', explode(',', $value));
    }

    public function name($value) {
        $likeStr = str_replace('*', '%', $value);

        return $this->builder->where('name', 'like', $likeStr);
    }
}