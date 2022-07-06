<template>
    <nav class="bg-primary d-flex align-items-center">
        <router-link to="/">Home</router-link>
        <router-link to="/customers">Customers</router-link>
        <router-link to="/products">Products</router-link>
        <router-link to="/orders">Orders</router-link>
    </nav>
</template>

<script>
export default {
  name: 'NavComponent'
}
</script>

<style scoped>
  nav {
    height: 10vh;
  }
  nav > a {
    padding-left: 10px;
    padding-right: 10px;
    color: white;
  }
</style>
