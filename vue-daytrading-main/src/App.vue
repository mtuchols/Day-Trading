<template>
  <top-header />
  <h1>Hello World</h1>
</template>

<script>
import topHeader from "./components/topHeader.vue";

export default {
  components: { topHeader },
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
}
</style>
