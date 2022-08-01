<template>
    <div>
        <span class="emoji">&#128075;</span> Hello, {{ this.$store.state.user.name }}!
    </div>
</template>

<script>
export default {
    name: "Home",
}
</script>

<style>
.emoji{
    font-size: 1.1rem;
}
</style>
