<template>
  <div>
    <h1>Editar Tarefas</h1>
    <formTasks :tasks="tasks" :updateting="true"></formTasks>
  </div>
</template>

<script>
import FormTasksComponent from "./partials/formTasksComponent.vue";
export default {
  props: {
    id: {
      require: true,
    },
  },
  created() {
    this.$store
      .dispatch("loadTask", this.id)
      .then((response) => {
        console.log(response);
        this.tasks = response;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  data() {
    return{
      tasks:{}
    }
  },
  components: {
    formTasks: FormTasksComponent,
  },
};
</script>