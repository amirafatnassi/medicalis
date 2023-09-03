<?php

namespace App\Http\View\Composers;

use App\Models\Ville;
use Illuminate\View\View;

class VilleComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Villes', Ville::all());
    }
}