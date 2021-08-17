<template>
  <div class="preloader" v-show="preloader">
    <img src="/images/preloader.gif" alt="Carregando" /> 
  </div>
</template>

<script>
export default {
    computed: {
        preloader() {
             return this.$store.state.Preloader.loading
        }
    }
};
</script>


<style scoped>
.preloader{
  position: absolute;
  z-index: 999;
  opacity: .2;
  width: 100%;
  height: 100%;
  margin: 0;
  text-align: center;
  padding: 50% 0;

}
.preloader img{

}
</style>