<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Action extends Model
{
    use HasFactory;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    static public function pagination(array $filter, array $options)
    {
        $limit      = isset($options["limit"]) ? (int) ($options["limit"]) : 15;
        $page       = isset($options["page"]) ? (int) $options["page"] : 1;
        $skip       = ($page - 1) * $limit;
        $totalRows  = DB::table('actions')->count();
        $totalPages = ceil($totalRows / $limit);

        $columns    = ["id", "name", "slug", "description", "enabled", "createdAt", "updatedAt"];

        $query      = DB::table('actions');
        $query->select($columns);

        if(isset($options["sortBy"])) {

        }

        $query->offset($skip);
        $query->limit($limit);

        $data = $query->get();

        return [
            "results" => $data,
            "page" => $page,
            "limit" => $limit,
            "totalPages" => $totalPages,
            "totalResults" => $totalRows
        ];
    }
}
