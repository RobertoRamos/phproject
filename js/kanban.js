Vue.component('kanban-board', {
    props: ['group-id', 'sprint-id'],
    data: function () {
        return {
            swimlanes: [],
            issues: [],
        };
    },
    template: '\
        <div class="kanban-board">\
            <kanban-swimlane\
                :key="lane.id"\
                :name="lane.name"\
                :issues="issuesByStatus(lane.id)"\
                v-for="lane in swimlanes" />\
        </div>',
    methods: {
        issuesByStatus: function (status) {
            return this.issues.filter(function (issue) {
                return issue.status == status;
            });
        },
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
                // TODO: enable drag-and-drop between swimlanes
                // TODO: enable sorting items within swimlanes
            }, 'json');
        }, 'json');
    }
});
Vue.component('kanban-swimlane', {
    props: ['name', 'issues'],
    data: function () {
        return {};
    },
    template: '\
        <div class="panel panel-default kanban-swimlane">\
            <div class="panel-heading">\
                {{ name }}\
            </div>\
            <div class="panel-body">\
                <kanban-issue\
                    :key="issue.id"\
                    :issue="issue"\
                    v-for="issue in issues" />\
            </div>\
        </div>'
});
Vue.component('kanban-issue', {
    props: ['issue'],
    template: '\
        <div class="panel panel-default kanban-issue">\
            <div class="panel-body">\
                {{ issue.name }}<br>\
                <small>{{ issue.author_name }}</small>\
            </div>\
        </div>'
});
var app = new Vue({
    el: '#root'
});
