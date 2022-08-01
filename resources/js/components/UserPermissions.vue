<template>
    <div v-if="permissions">
        <h6>User permissions:</h6>
        <div class="form-check" v-for="permission in permissions" :key="permission.id">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" :value="permission.id" v-model="userPermissions">
                {{ permission.title }}
            </label>
        </div>
    </div>

</template>

<script>
export default {
    name: "UserPermissions",
    props: [
        'user',
    ],
    data() {
        return {
            permissions: null,
            userPermissions: [],
        }
    },
    created() {
        this.permissionsList()
    },
    methods: {
        permissionsList() {
            axios.get('permissions').then(response => {
                this.permissions = response.data
                if(this.user)
                    this.userPermissions = this.user.permissions
            })
        }
    }
}
</script>

<style scoped>

</style>
