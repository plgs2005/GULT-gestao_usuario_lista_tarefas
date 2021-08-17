<template>
  <div>
    <h1>Editar Categoria</h1>

    <formStatus :status="item" :updateting="true" ></formStatus>
  </div>
</template>

<script>
import FormStatusComponent from "./partials/formStatusComponent";
export default {
  props: {
    id: {
      require: true,
    },
  },
  created() {
    this.$store
      .dispatch("loadItem", this.id)
      .then((response) => {
          console.log("console"+JSON.stringify(response))
        this.item.id = JSON.stringify(response.id),
        this.item.name = JSON.stringify(response.status)
      })
      .catch((error) => {
        console.log(error);
      });
  },
  data() {
    return {
      item: {
          id:'',
          name:''
      },
    };
  },
  
  components: {
      formStatus: FormStatusComponent,
    },
};
</script>