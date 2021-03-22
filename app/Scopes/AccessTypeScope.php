<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AccessTypeScope implements Scope
{
    //INFO: https://www.itsolutionstuff.com/post/laravel-global-scope-tutorial-exampleexample.html


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //Nese useri e ka te caktuar qasjen publice ose private
        //Merr nga sessioni variablen public, nese shte e pacaktuar merr default false(te dhenat me qasje jo-publike nuk mund te behen fetch nga db)
        $access_type = session()->get('public',false);

        //Nese qasja eshte publike merr Vetem te dhenat publike
        if($access_type){
            $builder->where('public', '=', TRUE);
        }
    }
}
