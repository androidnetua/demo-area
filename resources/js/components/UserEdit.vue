<template>
    <div class="row" v-if="user">
        <div class="col-auto">
            <UserForm :user="user" ref="UserForm"></UserForm>
            <div class="mt-3">
                <button class="btn btn-primary me-3" @click="updateUser">Update user</button>
                <user-cancel-button></user-cancel-button>
            </div>
        </div>
        <div class="col-auto ms-4">
            <button class="btn btn-danger btn-sm mb-4" @click="deleteUser">Delete user</button>
            <user-permissions :user="user" ref="UserPermissions"></user-permissions>
        </div>
    </div>
</template>

<script>
import UserForm from "./UserForm";
import UserCancelButton from "./UserCancelButton";
import UserPermissions from "./UserPermissions";
export default {
    name: "UserEdit",
    components: {UserPermissions, UserCancelButton, UserForm},
    data(){
        return {
            user: null,
        }
    },
    methods: {
        getUser(){
            axios.get(`users/${this.$route.params.id}`).then(response => {
                this.user = response.data.data
            })
        },
        updateUser(){
            axios.put(`users/${this.$route.params.id}`, {
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
        },
        deleteUser(){
            axios.delete(`users/${this.$route.params.id}`)
                .then((response) => {
                    this.$toast.info(response.data.message)
                    this.$router.push({name: 'users'})
                }).catch(error => {
                    this.$toast.danger(error.response.data.message)
            })
        },
    },
    mounted() {
        this.getUser()
    }
}
</script>

<style scoped>

</style>
