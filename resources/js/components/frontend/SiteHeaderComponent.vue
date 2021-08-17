<template>
  <div>
    <ul class="nav">
      <li class="nav-item">
        <router-link :to="{ name: 'home' }" class="nav-link">
          Home
        </router-link>
      </li>

      <li class="nav-item">
        <router-link :to="{ name: 'login' }" class="nav-link">
          Login
        </router-link>
      </li>

      <li class="nav-item">
        <a href="#" @click.prevent="logout" class="nav-link">Sair</a>
      </li>
    </ul>
  </div>
</template>


<script>
export default {
  computed: {
    me() {
      return this.$store.state.Auth.me;
    },
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
      this.$router.push({ name: "login" });
    },
  },
};
</script>