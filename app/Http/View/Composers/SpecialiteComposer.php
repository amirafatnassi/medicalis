<?php

namespace App\Http\View\Composers;

use App\Models\Specialite;
use Illuminate\View\View;

class SpecialiteComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Specialites', Specialite::all());
    }
}