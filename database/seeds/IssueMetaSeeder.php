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
        ]);
        DB::table('issue_types')->insert([
            'name' => 'Project',
            'role' => 'project',
        ]);
        DB::table('issue_types')->insert([
            'name' => 'Bug',
            'role' => 'bug',
        ]);
        DB::table('issue_statuses')->insert([
            'name' => 'New',
        ]);
        DB::table('issue_statuses')->insert([
            'name' => 'Active',
        ]);
        DB::table('issue_statuses')->insert([
            'name' => 'Closed',
            'closed' => 1,
        ]);
        DB::table('issue_priorities')->insert([
            'value' => 0,
            'name' => 'Normal',
        ]);
        DB::table('issue_priorities')->insert([
            'value' => 1,
            'name' => 'High',
        ]);
        DB::table('issue_priorities')->insert([
            'value' => -1,
            'name' => 'Low',
        ]);
    }
}
