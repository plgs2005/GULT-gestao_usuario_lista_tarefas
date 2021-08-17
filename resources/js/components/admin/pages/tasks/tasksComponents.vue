<template>
  <div>
    <h1>Lista de Tarefas</h1>

    <div class="row">
      <div class="col">
        <router-link
          :to="{ name: 'admin.tasks.create' }"
          class="btn btn-success"
          >Cadastrar</router-link
        >
      </div>
      <div class="col">
        <search @search="search"></search>
      </div>
    </div>

    <table class="table table-dark">
      <thead>
        <tr>
          <td>id</td>
          <td>Tarefa</td>
          <td>ação</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(tasks, index) in tasks.data.data" :key="index">
          <td>{{ tasks.id }}</td>
          <td v-text="tasks.name"></td>
          <td>
            <router-link
              :to="{ name: 'admin.tasks.edit', params: { id: tasks.id } }"
              class="btn btn-primary"
            >
              Editar</router-link
            >
            <a
              href="#"
              class="btn btn-danger"
              @click.prevent="destroy(tasks.id)"
              >Excluir</a
            >
          </td>
        </tr>
      </tbody>
    </table>
    <ul v-if="this.tasks.last_page > '1'">
      <li v-if="this.tasks.current_page < '1'">
        <a href="" @click.prevent="loadTasks(this.tasks.current_page - 1)"
          >Anterior
        </a>
      </li>
      <li v-if="this.tasks.current_page < tasks.last_page">
        <a href="" @click.prevent="loadTasks(this.tasks.current_page + 1)">
          Próximo
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

import SearchComponent from "./partials/searchComponent.vue";

export default {
  created() {
    this.loadTasks();
  },
  data() {
    return {
      search: "",
    };
  },
  computed: {
    tasks() {
      return this.$store.state.Tasks.items;
    },
    params() {
      return {
        page: this.tasks.current_page,
        filter: this.search,
      };
    },
  },
  components: {
    search: SearchComponent,
  },
  methods: {
     destroy(tasks) {
      console.log(tasks);

      this.$store
        .dispatch("destroyTasks", tasks)
        .then(() => {
          this.$snotify.success("Sucesso ao deletar");
          this.$router.push({ name: "admin.tasks" });
        })
        .catch((error) => {
          console.log(error);
          this.$snotify.error("Algo deu errado", "Erro");
        });
    },

    loadTasks(page = 1) {
      this.$store.dispatch("loadTasks", { ...this.params, page });
      console.log("pagina" + this.loadTasks);
    },
    searchForm(filter) {
      this.search = filter;
    },
  },
};
</script>
