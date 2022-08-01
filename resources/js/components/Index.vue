<template>
    <div v-if="user">
        <div class="row" v-if="user.activated">
            <div class="col-auto">
                <Menu></Menu>
            </div>
            <div class="col-auto">
                <router-view></router-view>
            </div>
        </div>
        <password v-else></password>
        <toasts></toasts>
    </div>
</template>

<script>
import Menu from "./Menu";
import Password from "./Password";
import Toasts from "../plugins/Toaster/Toasts";
export default {
    name: "Index",
    components: {Toasts, Menu, Password},
    computed: {
        user: function() {
            return this.$store.state.user
        },
    },
}
</script>

<style>
    input[type=text],
    select.form-select
    {
        width: 200px;
    }
</style>
