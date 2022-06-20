<template>
  <Header />
  <router-view />
  <Footer />
</template>

<script>
import Header from "./layout/Header/Header.vue";
import Footer from "./layout/Footer/Footer.vue";


export default {
  components: { Header, Footer},
  setup()
  {


  }

};
</script>

<style lang="scss" scoped>
</style>
