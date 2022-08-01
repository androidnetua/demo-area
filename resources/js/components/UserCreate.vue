<template>
    <div class="row">
        <div class="col-auto">
            <UserForm ref="UserForm"/>
            <div class="mt-3">
                <button class="btn btn-primary me-3" @click="userCreate">Create user</button>
                <user-cancel-button></user-cancel-button>
            </div>
        </div>
        <user-permissions class="col-auto ms-4" ref="UserPermissions"></user-permissions>
    </div>
</template>

<script>
import UserForm from "./UserForm";
import UserCancelButton from "./UserCancelButton";
import UserPermissions from "./UserPermissions";
export default {
    name: "UserCreate",
    components: {UserPermissions, UserCancelButton, UserForm},
    methods: {
        userCreate() {
            axios.post('users', {
                name: this.$refs.UserForm.name,
                login: this.$refs.UserForm.login,
                email: this.$refs.UserForm.email,
                password: this.$refs.UserForm.password,
                activated: this.$refs.UserForm.activated,
                permissions: this.$refs.UserPermissions.userPermissions,
            }).then(response => {
                this.$toast.success(response.data.message)
                this.$router.push({name: 'users'})
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        }
    }
}
</script>

<style scoped>

</style>
