<?php

namespace App\Http\View\Composers;

use App\Models\Acte;
use Illuminate\View\View;

class ActeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Actes', Acte::all());
    }
}