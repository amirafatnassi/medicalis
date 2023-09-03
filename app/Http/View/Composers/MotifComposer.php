<?php

namespace App\Http\View\Composers;

use App\Models\Motif;
use Illuminate\View\View;

class MotifComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Motifs', Motif::all());
    }
}