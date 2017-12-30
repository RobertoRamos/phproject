<template>
    <div class="issue-history" v-if="history.length">
        <issue-history-item
            v-for="item in history"
            :key="item.id"
            :item="item">
        </issue-history-item>
    </div>
    <p v-else>
        No changes have been made to this issue.
    </p>
</template>

<script>
import issueHistoryItem from './IssueHistoryItem.vue'

export default {
    components: {
        issueHistoryItem
    },
    props: {
        issueId: {
            type: String, // used as Number
            required: true
        }
    },
    data () {
        return {
            history: []
        }
    },
    methods: {
        callAjax() {
            const instance = this;
            axios.get('/issues/' + instance.issueId + '/history')
                .then(function (response) {
                    instance.history = response.data
                })
                .catch(function (error) {
                    console.log(error)
                })
        }
    },
    mounted() {
        this.callAjax()
    }
}
</script>
