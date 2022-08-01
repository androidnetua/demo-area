<template>
<div>
    <div class="list-group-flush">
        <a href="#" class="list-group-item list-group-item-action"
           :data-id="device.id" v-for="device in devices"
           @click.prevent="$emit('load', $event.target.dataset.id)"
        >
            {{ device.vendor.name }}
            {{ device.name }}
        </a>
    </div>
</div>
</template>

<script>
export default {
    name: "SpecsList",
    props: [
        'type',
    ],
    data(){
        return {
            devices: [],
        }
    },
    methods: {
        getList() {
            axios.get('specs/' + this.type).then(response => {
                this.devices = response.data.data
            })
        },
    },
    mounted() {
        this.getList()
    },
}
</script>
