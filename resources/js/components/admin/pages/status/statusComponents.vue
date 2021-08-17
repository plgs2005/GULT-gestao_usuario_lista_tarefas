<template>
  <div>
    <h1>Status de Tarefas</h1>
    <div class="row">
      <div class="col">
        <router-link :to="{ name: 'admin.status.create' }" class="btn btn-success">Cadastrar</router-link
        >
      </div>
      <div class="col">
        <search @searchStatus="search"></search>
      </div>
    </div>

    <table class="table table-dark">
      <thead>
        <tr>
          <td>id</td>
          <td>Staus</td>
          <td>ação</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(status, index) in status.data" :key="index">
          <td>{{ status.id }}</td>
          <td v-text="status.status"></td>
          <td>
            <router-link :to="{ name: 'admin.status.edit', params: { id: status.id } }" class="btn btn-primary">
              Editar</router-link
            >
            <a
              href="#"
              class="btn btn-danger"
              @click.prevent="destroy(status.id)"
              >Excluir</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import searchStatusComponent from "./partials/searchComponent.vue";
export default {
  created() {
    this.$store.dispatch("loadStatus", { name: this.name });
  },

  data() {
    return {
      name: "",
    };
  },
  computed: {
    status() {
      return this.$store.state.Status.items;
    },
  },
  methods: {
    loadStatus(){
      this.$store.dispatch('loadStatus', {name: this.name})
    },


    destroy(status) {
      console.log(status);

      this.$store
        .dispatch("destroyStatus", status)
        .then(() => {
          this.$snotify.success("Sucesso ao deletar");
          this.$router.push({ name: "admin.status" });
        })
        .catch((error) => {
          console.log(error);
          this.$snotify.error("Algo deu errado", "Erro");
        });
    },
    search(filter){
      this.name=filter
      this.loadStatus()
    }
  },
  components: {
    search: searchStatusComponent,
  },
};
</script>
