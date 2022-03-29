<template>
  <div class="navbar">
    <img src="../assets/logo.png" />
    <a href="#">Home</a>
    <a href="#">Account</a>
    <a href="#">Trade</a>
    <a href="#">Curated</a>
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
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  background-color: #333;
}
.navbar a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}
</style>
