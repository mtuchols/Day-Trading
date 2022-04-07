<template>
  <div id="app">
    <header-component />
    <router-view />
  </div>
</template>

<script>
import headerComponent from "./components/header.vue";

export default {
  components: {
    "header-component": headerComponent,
  },
  name: "App",
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-left: -8px;
  margin-right: -8px;
  margin-top: -8px;
}
body {
  background-color: #99c3ef;
}
</style>
