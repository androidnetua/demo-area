<template>
    <div class="list-group">
        <router-link :to="{name: 'home'}" class="list-group-item ps-3">Home</router-link>
        <router-link :to="{name: 'users'}" class="list-group-item ps-3" v-if="can('manage-users')">Users</router-link>
        <a href="#specsMenu" class="list-group-item ps-3 collapsed collapse-menu" data-bs-toggle="collapse" role="button" data-bs-target="#specsMenu" v-if="can('specs')">Specs</a>
        <div class="collapse" id="specsMenu" v-if="can('specs')">
            <router-link :to="{name: 'specs.cpu'}" class="list-group-item ps-4 border-top-0">CPU</router-link>
            <router-link :to="{name: 'specs.gpu'}" class="list-group-item ps-4">GPU</router-link>
        </div>
        <a href="/area3/logout" class="list-group-item ps-3 border-top-0">Logout</a>
    </div>
</template>

<script>
export default {
    name: "Menu",
    methods: {
        can (permissionName) {
            return this.$store.state.user.permissions.some(permission => {
                return permission.name === permissionName
            })
        },
    },
}
</script>

<style scoped>
.list-group{
    min-width: 200px;
}
a.list-group-item{
    color: inherit;
}

</style>
