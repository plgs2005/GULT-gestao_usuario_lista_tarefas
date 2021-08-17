<template>
  <div>
    <ul class="nav bg-dark">
      <li class="nav-item">
        <router-link :to="{ name: 'admin.dashboard' }" class="nav-link">
          Dashboard</router-link
        >
      </li>
      <li>
        <router-link :to="{ name: 'admin.status' }" class="nav-link">
          Status de Tarefas
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'admin.tasks' }" class="nav-link">
          Novas Tarefas ({{ totalTasks }})
        </router-link>
      </li>

      <li class="nav-item">
        <div class="row">
        <a href="#" class="nav-link">{{ me.name}} (<a href="#" @click.prevent="logout"> sair</a>)</a>  
        
        </div>

      </li>
    </ul>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    totalTasks() {
      console.log(this.$store.state.Tasks.items.data.total);
      return this.$store.state.Tasks.items.data.total;
    },
    me (){
      return this.$store.state.Auth.me
    }
  },
  methods: {
    logout() {
      this.$store.dispatch("logout")
      this.$router.push({name: 'login'})
    },
  },
};
</script>
