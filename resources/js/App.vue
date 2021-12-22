<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Worldwide</router-link>
                    <router-link to="/list" class="nav-item nav-link">Country List</router-link>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
name: "App"
}
</script>

<style scoped>

</style>
