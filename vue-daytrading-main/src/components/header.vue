<template>
  <div class="navbar">
    <img src="../assets/logo.png" />
    <router-link to="/home">Home</router-link> |
    <router-link to="/trade">Trade</router-link>
    <router-link to="/curated">Curated</router-link>
    <a href="#">Logout</a>
  </div>
</template>

<script>
export default {
  name: "headerComponent",
};
</script>

<style scoped>
/* header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
} */
.navbar {
  display: flex;
  justify-content: normal;
  align-items: center;
  margin-bottom: 10px;
  margin-top: -8px;
  margin-left: -8px;
  margin-right: -8px;
  background-color: #333;
}
.navbar a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}
</style>
