<template>
  <div>
    <h1>Cadastro de Status para Tarefas</h1>
    <formStatus></formStatus>
  </div>
</template>

<script>
import FormStatusComponent from "./partials/formStatusComponent";

export default {
  
  components: {
    formStatus: FormStatusComponent,
  },
};
</script>