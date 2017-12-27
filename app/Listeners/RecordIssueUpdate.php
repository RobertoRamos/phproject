<?php

namespace App\Listeners;

use App\IssueUpdate;
use App\IssueUpdateData;
use App\Events\IssueUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordIssueUpdate
{
    /**
     * Fields to ignore when logging an update
     *
     * @var array
     */
    protected $ignoredFields = [
        'updated_at'
    ];

    /**
     * Log the update and field changes
     *
     * @param  IssueUpdated  $event
     * @return void
     */
    public function handle(IssueUpdated $event)
    {
        // Only log authenticated updates
        if (!$event->user || !$event->issue) {
            return;
        }

        $dirty = $event->issue->getDirty();
        if (!$dirty) {
            return;
        }

        $record = IssueUpdate::create([
            'issue_id' => $event->issue->id,
            'user_id' => $event->user->id
        ]);
        foreach ($dirty as $field => $value) {
            if (in_array($field, $this->ignoredFields)) {
                continue;
            }
            IssueUpdateData::create([
                'update_id' => $record->id,
                'field' => $field,
                'old_value' => $event->issue->getOriginal($field),
                'new_value' => $value,
            ]);
        }
    }
}
