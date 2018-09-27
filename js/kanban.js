Vue.component('kanban-board', {
    props: {
        'group-id': Number,
        'sprint-id': Number
    },
    data: function () {
        return {
            swimlanes: [],
            issues: [],
            isLoading: true,
        };
    },
    template: '\
        <div class="kanban-board" :class="isLoading && \'is-loading\'">\
            <div class="panel panel-default kanban-swimlane"\
                :data-id="lane.id"\
                v-for="lane in swimlanes">\
                <div class="panel-heading">\
                    {{ lane.name }}\
                </div>\
                <div class="panel-body">\
                    <draggable\
                        :options="{group: \'kanban\', draggable: \'.kanban-issue\'}"\
                        @end="onIssueMove">\
                        <kanban-issue\
                            v-for="issue in issues"\
                            v-if="issue.status == lane.id"\
                            :key="issue.id"\
                            :issue="issue" />\
                    </draggable>\
                </div>\
            </div>\
        </div>',
    methods: {
        onIssueMove: function (event) {
            let status = $(event.to).closest('.kanban-swimlane').attr('data-id');
            let issue = this.issues[this.issues.findIndex(function (issue) {
                return issue.id == $(event.item).attr('data-id');
            })];

            // TODO: update sort on backend
            issue.status = status;
            $.post(BASE + '/kanban/move/' + issue.id, {
                status: status,
            });
        }
    },
    mounted: function () {
        var component = this,
            group = this.$props.groupId,
            sprint = this.$props.sprintId;
        $.get(BASE + '/kanban/boardLanes', function (data) {
            component.swimlanes = data;
            $.get(BASE + '/kanban/boardData', {
                group: group,
                sprint: sprint,
            }, function (data) {
                component.issues = data;
                component.isLoading = false;
            }, 'json');
        }, 'json');
    }
});

Vue.component('kanban-issue', {
    props: {
        'issue': Object
    },
    template: '\
        <div class="panel panel-default kanban-issue"\
            :style="\'border-left-color: #\' + issue.owner_task_color"\
            :data-id="issue.id">\
            <div class="panel-body">\
                {{ issue.name }}<br>\
                <small>{{ issue.owner_name }}</small>\
            </div>\
        </div>'
});

var app = new Vue({
    el: '#root'
});
