<template>
  <div class="navbar">
    <img src="../assets/logo.png" />
    <h1>Tech Trading</h1>
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
  margin-bottom: 24px;
  margin-top: 24px;
  margin-left: 24px;
  margin-right: 24px;
  background-color: #030e12;
  border-radius: 15px;
}
.navbar a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}
h1 {
  color: #fcde67;
  padding-right: 10px;
  padding-left: 10px;
}
img {
  padding-left: 10px;
}
</style>
