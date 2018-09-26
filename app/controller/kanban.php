<?php

namespace Controller;

use Helper\View;
use Model\Issue\Detail as Issue;
use Model\Issue\Status;
use Model\Issue\Type;
use Model\Sprint;
use Model\User;
use Model\User\Group;

class Kanban extends \Controller
{
    public function __construct()
    {
        $this->_userId = $this->_requireLogin();
    }

    /**
     * View a Kanban board
     *
     * Accepts parameters: group, sprint
     *
     * @param \Base $f3
     * @param array $params
     */
    public function index($f3, $params)
    {
        $group = new User;
        $group->load($params['group']);
        if (!$group->id) {
            $f3->error(404);
            return;
        }

        $sprint = new Sprint;
        if (empty($params['id']) || !intval($params['id'])) {
            $localDate = date('Y-m-d', View::instance()->utc2local());
            $sprint->load(['? BETWEEN start_date AND end_date', $localDate]);
        } else {
            $sprint = $sprint->load($params['sprint']);
        }
        if (!$sprint->id) {
            $f3->error(404);
            return;
        }

        $f3->set('group', $group->id);
        $f3->set('sprint', $sprint->id);
        $this->_render("kanban/index.html");
    }

    /**
     * Get swimlanes for the Kanban board
     * @param \Base $f3
     */
    public function boardLanes($f3)
    {
        $statusModel = new Status;
        $statuses = $statusModel->find('taskboard > 0', ['order' => 'taskboard_sort ASC']);
        $return = [];
        foreach ($statuses as $status) {
            $return[] = $status->cast();
        }
        $this->_printJson($return);
    }

    /**
     * Get items on the Kanban board
     * @param \Base $f3
     */
    public function boardData($f3)
    {
        $groupId = $f3->get('GET.group');
        if (!$groupId) {
            $f3->error(400, 'A group ID is required to load board data.');
        }
        $sprintId = $f3->get('GET.sprint');
        if (!intval($sprintId)) {
            $f3->error(400, 'A sprint ID is required to load board data.');
        }

        // Add owner/sprint filters
        $user = new User;
        $user->load($groupId);
        if ($user->role == 'group') {
            $groupModel = new Group;
            $groupUsers = $groupModel->find(['group_id = ?', $user->id]);
            $filterUsers = [intval($groupId)];
            foreach ($groupUsers as $u) {
                $filterUsers[] = $u['user_id'];
            }
        } else {
            $filterUsers = [intval($groupId)];
        }
        $ownerStr = implode(',', $filterUsers);
        $filter = "owner_id IN ($ownerStr)";
        $filter .=  ' AND sprint_id = ' . intval($sprintId);

        // Add status filter
        $statusModel = new Status;
        $statuses = $statusModel->find('taskboard > 0', ['order' => 'taskboard_sort ASC']);
        $statusIds = [];
        foreach ($statuses as $status) {
            $statusIds[] = $status->id;
        }
        $statusStr = implode(',', $statusIds);
        $filter .= " AND status IN ($statusStr)";

        // Add type filter
        $type = new Type;
        $types = $type->find(['role = ?', 'project']);
        $typeIds = [];
        foreach ($types as $type) {
            $typeIds[] = $type->id;
        }
        $typeStr = implode(',', $typeIds);
        $filter .= " AND type_id IN ($typeStr)";

        // Find issues
        $issueModel = new Issue;
        $issues = $issueModel->find($filter);
        $return = [];
        foreach ($issues as $issue) {
            $return[] = $issue->cast();
        }

        $this->_printJson($return);
    }
}
