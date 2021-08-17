<template>
  <div>
    <form class="form" @submit.prevent="onSubmit">
      <div class="form-group">
        <label>Status da Tarefa</label>
        <div v-if="errors.message">{{errors.message}}</div>
        <input
          type="text"
          class="form-control"
          v-model="status.name"
          id="status"
        />
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    status: {
      require: false,
      type: Object | Array,
      default: () => {
        return {
          id: "",
          name: "",
        };
      },
    },
    updateting: {
      require: false,
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
        errors:{

        }
    };
  },
  methods: {
    onSubmit() {
      const action = this.updateting ? "updateStatus" : "storeStatus";

      this.$store
        .dispatch(action, { id: this.status.id, status: this.status.name })
        .then(() => {
            this.$snotify.success('Sucesso ao cadastrar')
            this.$router.push({ name: "admin.status" })
        })
        .catch((error) => {
          console.log(error.response.data)
            this.$snotify.error('Algo deu errado', 'Erro')
          this.errors = error.response.data
        });
    },
  },
};
</script>