<template>
  <div>
      <NavComponent />
      <router-view />
  </div>
</template>

<script>
import NavComponent from './components/NavComponent.vue'
export default {
  name: 'App',
  components: {
    NavComponent
  }
}
</script>


<style>
  * {
    padding: 0px;
    margin: 0px;
  }
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  .app {
    position: relative;
    height: 100vh;
  }

  label.text-dark {
    position: relative;
    z-index: 9998;
    padding: 0px;
    margin: 0px;
    top: 10px;
    left: 5px;
    padding-left: 3px;
    padding-right: 3px;
    background-color: white;
  }
  div.form-group {
    padding: 0px;
    margin: 10px;
  }
  th.head {
    cursor: pointer;
  }
</style>
