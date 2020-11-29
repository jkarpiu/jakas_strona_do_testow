<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Logowanie</div>

          <div class="card-body">
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                  >"Adres e-mail"</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value=""
                    required
                    autocomplete="email"
                    autofocus
                    v-model="email"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Hasło
                </label>
                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="current-password"
                    v-model="password"
                  />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="remember"
                      id="remember"
                    />
                    <label class="form-check-label" for="remember">
                      Zapamiętaj
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button
                    @click="login"
                    class="btn btn-primary btn-login-page">
                    Zaloguj
                  </button>

                  <a class="btn btn-primary btn-karp btn-login-page" href=""
                    >Zapomniałeś hasła?
                  </a>

                  <a href="http://google.com/login" class="btn-google" style="text-decoration: none">
                    <div class="google-icon-box">
                      <img
                        class="google-icon"
                        src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                      />
                    </div>
                    <div class="google-text">Zaloguj się z Google</div>
                  </a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
let ctx;
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login: async () => {
        console.log(ctx)
      axios
        .post("/api/login", {
          email: ctx.email,
          password: ctx.password
        })
        .catch((err) => {
          console.log(err);
        }).then(() => {
            window.location.href ="/";
        });
    },
  },
  created() {
      ctx = this;
  }
};
</script>