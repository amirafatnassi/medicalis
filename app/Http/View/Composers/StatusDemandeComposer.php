<?php

namespace App\Http\View\Composers;

use App\Models\StatusDemande;
use Illuminate\View\View;

class StatusDemandeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('StatusDemandes', StatusDemande::all());
    }
}