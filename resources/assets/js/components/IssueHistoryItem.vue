<template>
    <div class="media issue-history-item">
        <!-- TODO: update image URL to be dynamic -->
        <img class="mr-3 rounded-circle" src="/img/default-avatar.svg" alt>
        <div class="media-body">
            <h5 class="mt-0"><a :href="item.user.username">{{ item.user.name }}</a></h5>
            <ul class="list-unstyled issue-history-item-changes">
                <li
                    v-for="change in item.update_data"
                    v-bind:key="change.id">
                    {{ change.field }} changed from {{ change.old_value }} to {{ change.new_value }}
                </li>
            </ul>
            <span class="text-muted">{{ item.created_at }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true
        }
    }
}
</script>
