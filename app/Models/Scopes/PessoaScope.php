<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PessoaScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $Builder
     * @param  \Illuminate\Database\Eloquent\Model  $Model
     * @return void
     */
    public function apply(Builder $Builder, Model $Model)
    {
        $id = session()->get('pessoa.id');
        $Builder->where('papel','<>',$Model::PAPEL_SISTEMA)->where('id','<>',$id);
        return $Builder;
    }
}
