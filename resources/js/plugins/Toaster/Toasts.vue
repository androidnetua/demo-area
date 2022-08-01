<template>
    <div class="toasts_wrapper">
        <TransitionGroup name="toasts">
        <div class="alert mb-3 shadow-sm"
             :class="'alert-' + (toast.type ?? 'info')"
             v-for="(toast) in this.$store.getters['toasts/toasts']"
             :key="toast.id"
             @click="this.$store.commit('toasts/hideToast', toast.id)">
            {{ toast.message }}
        </div>
        </TransitionGroup>
    </div>
</template>

<script>
export default {
    name: "Toasts",
}
</script>

<style scoped>
.toasts_wrapper{
    position: fixed;
    top: 1em;
    right: 1em;
    width: 25%;
    max-width: 400px;
    cursor: pointer;
    /*z-index: 100;*/
}
.shadow-sm{
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) !important;
}
.toasts-enter-active,
.toasts-leave-active {
    transition: all 0.25s ease;
}
.toasts-enter-from,
.toasts-leave-to {
    transform: translateX(400px);
}
.toasts-move{
    transition: all 0.25s ease;
}
.toasts-leave-active {
    position: absolute;
    width: 100%;
}
</style>
