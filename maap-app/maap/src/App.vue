<template>
  <div id="app">
    <header-menu></header-menu>
    <div class="container">
      <router-view/>
    </div>
  </div>
</template>

<script>
import HeaderMenu from './components/Header'
export default {
  name: 'App',
  components: {
    HeaderMenu
  }
}
</script>

<style lang='scss'>
@import "./style/main.scss";
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  .container {
    margin-top: px2rem(50px);
  }
}
</style>
