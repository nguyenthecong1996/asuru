<?php
namespace App\Libraries;

use Illuminate\Support\Str;

trait Filterable {
    public function scopeFilter($query, $request) 
    {
        $params = $request->all();
        foreach ($params as $field => $value) {
            if($field !== '_token' && !empty($value)) {
                $method = 'filter' . Str::studly($field);
                if(method_exists($this, $method)) {
                    $this->{$method}($query, $value);
                }
            }
        }
        return $query;
    }
}