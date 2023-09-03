<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class MedecinComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $users = User::where('role_id', 2)->get();
        $view->with('Medecins', $users);
    }
}
