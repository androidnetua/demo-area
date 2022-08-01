<template>
    <div>
        <div class="row">
            <div class="col">
                <label for="name" class="col-form-label">Name</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="name" v-model="name">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="login" class="col-form-label">Login</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="login" v-model="login">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="email" class="col-form-label">Email</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="email" v-model="email">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="password" v-model="password">
            </div>
        </div>
        <div class="form-check my-3">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" v-model="activated">
                activated
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserForm",
    data() {
        return {
            name: null,
            login: null,
            email: null,
            password: null,
            activated: false,
        }
    },
    props: {
        user: {
            default: null,
        }
    },
    mounted() {
        if(this.user) {
            this.name = this.user.name
            this.login = this.user.login
            this.email = this.user.email
            this.activated = Boolean(this.user.activated)
        }
        this.password = !this.user ? Math.random().toString(36).substring(2, 10) : ''
    },

}
</script>

<style scoped>

</style>
