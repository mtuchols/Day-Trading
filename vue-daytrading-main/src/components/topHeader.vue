<template>
  <div class="navbar">
    <a>Tech Trading</a>
    <a href="#">Account</a>
    <a href="#">Trade</a>
    <a href="#">Curated</a>
    <a href="#">Logout</a>
  </div>
</template>

<script>
export default {
  name: "topHeader",
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
