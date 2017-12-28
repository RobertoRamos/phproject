<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

/**
 * Composer class for providing backend data to primary app view
 */
class AppComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Make issue types available to the primary app view
        $issueTypes = \App\IssueType::all();
        $view->with('issueTypes', $issueTypes);
    }
}
