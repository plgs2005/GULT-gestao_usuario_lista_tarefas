<template>
  <div>
    <h1>Cadastro de Tarefas</h1>
    <formTasks></formTasks>
  </div>
</template>

<script>
import formTasksComponent from "./partials/formTasksComponent";

export default {
  
  components: {
    formTasks: formTasksComponent,
  },
};
</script>
