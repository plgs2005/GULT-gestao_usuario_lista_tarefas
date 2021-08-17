<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card">
          <div class="card-header">LOGIN</div>
          <div class="card-body">
            <form @submit.prevent="login">
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                  placeholder="digite seu email"
                  v-model="formData.email"
                />
                <small id="emailHelp" class="form-text text-muted"
                  >Digite um email ou cadastre-se.</small
                >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input
                  type="password"
                  class="form-control"
                  id="exampleInputPassword1"
                  placeholder="Senha"
                  v-model="formData.password"
                />
              </div>
              <br />
              <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      formData: {
        email: "",
        password: "",
      },
    }
  },
  methods: {
      login(){
          this.$store.dispatch('login',this.formData)
          .then(()=>this.$router.push({name:'admin.dashboard'}))
      }
  },
};
</script>