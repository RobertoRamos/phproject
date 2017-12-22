<?php

use Illuminate\Database\Seeder;

class IssueMetaSeeder extends Seeder
{
    /**
     * Add default issue metadata records
     *
     * @return void
     */
    public function run()
    {
        DB::table('issue_types')->insert([
            'name' => 'Task',
            'role' => 'task',
        ])->insert([
            'name' => 'Project',
            'role' => 'project',
        ])->insert([
            'name' => 'Bug',
            'role' => 'bug',
        ]);
        DB::table('issue_statuses')->insert([
            'name' => 'New',
        ])->insert([
            'name' => 'Active',
        ])->insert([
            'name' => 'Closed',
        ]);
        DB::table('issue_priorities')->insert([
            'value' => 0,
            'name' => 'Normal',
        ])->insert([
            'value' => 1,
            'name' => 'High',
        ])->insert([
            'value' => -1,
            'name' => 'Low',
        ]);
    }
}
