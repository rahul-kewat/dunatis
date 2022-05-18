<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3 w-full">
            <h1 class="text-left text-3xl text-80 font-bold">Recent Inspections</h1>
            <table class="table table-striped table-bordered w-full text-center">
                <thead>
                <tr>
                    <th>Inspection Area</th>
                    <th>Done By</th>
                    <th>Time Done</th>
                    <th>Notes</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="inspection in this.card.recentInspections" :key="inspection.id">
                    <td>{{ inspection.area && inspection.area.name}}</td>
                    <td>{{ inspection.user && inspection.user.username }}</td>
<!--                    <td>{{ moment.utc(inspection.completion_time*1000).format('HH:mm:ss') }}</td>-->
                    <td>{{ moment(inspection.updated_at).format('DD/MM/YYYY') }}</td>
                    <td>{{ inspection.notes }}</td>
                    <td>{{ moment(inspection.updated_at).format('DD/MM/YYYY') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
        console.log(this.card.recentInspections)
    },
}
</script>
