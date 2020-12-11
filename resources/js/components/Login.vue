<template>
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 5rem;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Logowanie</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-right"
                                >Adres e-mail</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    value=""
                                    required
                                    autocomplete="email"
                                    :class="{
                                        'is-invalid': $v.email.$error
                                    }"
                                    autofocus
                                    v-model.trim="$v.email.$model"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="!$v.email.required"
                                >
                                    Pole wymagane
                                </div>
                                <div
                                    class="invalid-feedback"
                                    v-if="!$v.email.email"
                                >
                                    To musi być poprawny adres email
                                </div>
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
                                    class="form-control"
                                    name="password"
                                    required
                                    v-model.trim="$v.password.$model"
                                    :class="{
                                        'is-invalid': $v.password.$error
                                    }"
                                    autocomplete="current-password"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="!$v.password.required"
                                >
                                    Pole wymagane
                                </div>
                                <div
                                    class="invalid-feedback"
                                    v-if="!$v.password.minLength"
                                >
                                    Hasło musi mieć co najmniej
                                    {{ $v.password.$params.minLength.min }}
                                    znaków.
                                </div>
                            </div>
                        </div>
                        <div v-if="errCode != null">
                            <p>Błędne dane logowania</p>
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
                                    <label
                                        class="form-check-label"
                                        for="remember"
                                    >
                                        Zapamiętaj
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button
                                    @click="login"
                                    class="btn btn-primary btn-login-page"
                                    :disabled="this.$v.$invalid"
                                >
                                    Zaloguj
                                </button>

                                <a
                                    class="btn btn-primary btn-karp btn-login-page"
                                    href=""
                                    >Zapomniałeś hasła?
                                </a>

                                <a
                                    href="/google_login"
                                    class="btn-google"
                                    style="text-decoration: none"
                                >
                                    <div class="google-icon-box">
                                        <img
                                            class="google-icon"
                                            src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                        />
                                    </div>
                                    <div class="google-text">
                                        Zaloguj się z Google
                                    </div>
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
import {
    required,
    minLength,
    between,
    email,
    sameAs
} from "vuelidate/lib/validators";
let ctx;
export default {
    data() {
        return {
            email: "",
            password: "",
            errCode: null
        };
    },
    validations: {
        email: {
            required,
            email
        },
        password: {
            required,
            minLength: minLength(8)
        }
    },
    methods: {
        login: async () => {
            if (!ctx.$v.$invalid) {
                console.log(ctx);
                axios
                    .post("/api/login", {
                        email: ctx.email,
                        password: ctx.password
                    })
                    .catch(err => {
                        console.log(err.response);
                        ctx.errCode = err.response.status
                    })
                    .then(() => {
                        if(!errCode) {
                        ctx.$emit("get-user");
                        ctx.$router.push("/");}

                    });
            }
        }
    },
    created() {
        ctx = this;
    }
};
</script>
<style scoped>
.card-header {
    font-size: 23px;
}
</style>
