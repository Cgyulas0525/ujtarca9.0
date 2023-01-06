<?php
namespace App\Classes;

use DB;

class DDDW{

    public $model;
    public $where;

    function __construct($model, $where = null)
    {
        $this->model = $model;
        $this->where = $where;
    }

    public function basicDDDW()
    {
        if (!empty($this->where)) {
            return DB::table($this->model)
                    ->whereNested(function ($query) {
                        foreach ($this->where as $k => $v) {
                            if ($v != ''){
                                if (is_array($v["values"])){
                                    $query->whereIn($k, $v["values"]);
                                }
                                else {
                                    $query->where($k, $v["op"], $v["values"]);
                                }
                            }
                        }
                    }, 'and')
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
        }
        return DB::table($this->model)->orderBy('name')->pluck('name', 'id')->toArray();
    }

}


