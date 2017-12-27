<?php

namespace App\Listeners;

use App\Events\IssueUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordIssueUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IssueUpdated  $event
     * @return void
     */
    public function handle(IssueUpdated $event)
    {
        //
    }
}
