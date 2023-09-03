<?php

namespace App\Http\View\Composers;

use App\Models\TypeDemande;
use Illuminate\View\View;

class TypeDemandeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('TypeDemandes', TypeDemande::all());
    }
}