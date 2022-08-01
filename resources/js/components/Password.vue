<template>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div>
            <h5 class="text-center mb-4">Please set your password</h5>
            <div class="row">
                <div class="col">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="password" class="form-control" v-model="password">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label for="password_confirmation" class="col-form-label">Confirm</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-3" @click="setPassword">Set password</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Password",
    data() {
        return {
            password: null,
            password_confirmation: null,
        }
    },
    methods: {
        setPassword(){
            axios.post('user/password', {
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then(() => {
                this.$router.go();
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        }
    },
}
</script>

<style scoped>

</style>
