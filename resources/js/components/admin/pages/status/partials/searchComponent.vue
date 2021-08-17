<template>
  <div>
    <form class="form form-inline" @submit.prevent="search">
      <input type="text" class="form-group mr-sm-2" placeholder="Buscar" v-model="filter" />
      <button type="submit" class="btn btn-outline-success">Buscar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: "",
    };
  },
  methods: {
    search() {
        this.$emit('searchStatus', this.filter)
    },
  },
};
</script>