<template>
  <div>
    <form class="form" @submit.prevent="onSubmit">
      <div class="form-group">
        <label for="name">Nome da Tarefa</label>
        <input
          type="text"
          class="form-control"
          id="name"
          aria-describedby="name"
          v-model="tasks.name"
        />
        <small id="name" class="form-text text-muted"
          >Digite um nome para esta tarefa</small
        >
      </div>
      <div class="form-group">
        <label for="name">Digite o id do status</label>
        <input
          type="text"
          class="form-control"
          id="tasks"
          aria-describedby="tasks"
          v-model="tasks.task_status_id"
        />
        <small id="tasks" class="form-text text-muted"
          >Confira o Id na lista de tasks</small
        >
      </div>

      <div class="form-group">
        <label for="tarefa">Data de entrega</label>
        <input type="text" v-model="tasks.completionDate" />
        <small id="tarefa" class="form-text text-muted"
          >Digite uma data de finalização desta tarefa</small
        >
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea2">Descrição da Tarefa</label>
        <textarea
          class="form-control rounded-0"
          rows="3"
          v-model="tasks.descripition"
        ></textarea>
        <small id="tarefa" class="form-text text-muted"
          >Digiete a descrição da tarefa</small
        >
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    tasks: {
      require: false,
      type: Object | Array,
      default: () => {
        return {
          id:'',
          name:'',
          descripition:'',
          completionDate:'',
          user_id: 1,
          task_status_id:'',
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
      item: {
        id: '',
        name: '',
        descripition: '',
        completionDate: '',
        user_id: 1,
        task_status_id: '',
      },
      errors: {},
    };
  },
  methods: {
    onSubmit() {
      const action = this.updateting ? "updateTasks" : "storeTasks";

      this.$store
        .dispatch(action, {
          id: this.tasks.id,
          name: this.tasks.name,
          descripition: this.tasks.descripition,
          completionDate: this.tasks.completionDate,
          user_id: 1,
          task_status_id: this.tasks.task_status_id,
        })
        .then((response) => {
           console.log(response);
         /*  this.$snotify.success("Sucesso ao cadastrar");
          this.$router.push({ name: "admin.tasks" }); */
        })
        .catch((error) => {
          console.log(error);
          
        });
    },
  },
};
</script>