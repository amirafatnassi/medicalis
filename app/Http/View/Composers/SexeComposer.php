<?php

namespace App\Http\View\Composers;

use App\Models\Sexe;
use Illuminate\View\View;

class SexeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Sexes', Sexe::all());
    }
}