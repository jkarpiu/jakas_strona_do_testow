<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="head-name">Rejestracja</div>
                            <div class="form-group roles2 row">
                                <div
                                    @click="setRole(1)"
                                    :style="setColor(1)"
                                    class="form-check roles"
                                    id="role1"
                                >
                                    Uczeń
                                </div>
                                <div
                                    @click="setRole(2)"
                                    :style="setColor(2)"
                                    class="form-check roles"
                                    id="role2"
                                >
                                    Nauczyciel
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="head">
                                    <input
                                        id="fname"
                                        type="text"
                                        class="form-control head-form"
                                        v-model.trim="$v.register.fname.$model"
                                        required
                                        placeholder="Podaj imię"
                                        :class="{
                                            'is-invalid':
                                                $v.register.fname.$error
                                        }"
                                        autocomplete="fname"
                                        autofocus
                                        style="grid-row: 1"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="!$v.register.fname.required"
                                        style="grid-row: 2; grid-column: 1;"
                                    >
                                        Pole jest wymagane
                                    </div>
                                    <div
                                        class="invalid-feedback"
                                        style="grid-row: 2; grid-column: 1;"
                                        v-if="!$v.register.fname.minLength"
                                    >
                                        Pole musi mieć co najmniej
                                        {{
                                            $v.register.fname.$params.minLength
                                                .min
                                        }}
                                        znaki.
                                    </div>

                                    <!-- @error('fname')
                                                    <span
                                                        class="invalid-feedback"
                                                        role="alert"
                                                    >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror -->

                                    <input
                                        id="lname"
                                        type="text"
                                        class="form-control head-form"
                                        v-model.trim="$v.register.lname.$model"
                                        :class="{
                                            'is-invalid':
                                                $v.register.lname.$error
                                        }"
                                        required
                                        placeholder="Podaj nazwisko"
                                        autocomplete="lname"
                                        autofocus
                                        style="grid-row:1;"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        style="grid-row: 2; grid-column: 2;"
                                        v-if="!$v.register.lname.required"
                                    >
                                        Pole jest wymagane
                                    </div>
                                    <div
                                        style="grid-row: 2; grid-column: 2;"
                                        class="invalid-feedback"
                                        v-if="!$v.register.lname.minLength"
                                    >
                                        Pole musi mieć co najmniej
                                        {{
                                            $v.register.lname.$params.minLength
                                                .min
                                        }}
                                        znaki.
                                    </div>
                                    <!-- @error('l name')
                                                        <span
                                                            class="invalid-feedback"
                                                            role="alert"
                                                        >
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        v-model.trim="$v.register.email.$model"
                                        :class="{
                                            'is-invalid':
                                                $v.register.email.$error
                                        }"
                                        required
                                        placeholder="Podaj adres e-mail"
                                        autocomplete="email"
                                    />

                                    <div
                                        class="invalid-feedback"
                                        v-if="!$v.register.email.required"
                                    >
                                        Pole wymagane
                                    </div>
                                    <div
                                        class="invalid-feedback"
                                        v-if="!$v.register.email.email"
                                    >
                                        To musi być poprawny adres email
                                    </div>
                                    <!-- @error('email')
                                                <span
                                                    class="invalid-feedback"
                                                    role="alert"
                                                >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror -->
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <input
                                        id="password"
                                        v-model.trim="
                                            $v.register.password.$model
                                        "
                                        type="password"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                $v.register.password.$error
                                        }"
                                        required
                                        placeholder="Podaj hasło"
                                        autocomplete="new-password"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="!$v.register.password.required"
                                    >
                                        Pole wymagane
                                    </div>
                                    <div
                                        class="invalid-feedback"
                                        v-if="!$v.register.password.minLength"
                                    >
                                        Hasło musi mieć co najmniej
                                        {{
                                            $v.register.password.$params
                                                .minLength.min
                                        }}
                                        znaków.
                                    </div>

                                    <!-- @error('password')
                                                <span
                                                    class="invalid-feedback"
                                                    role="alert"
                                                >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror -->
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        v-model.trim="
                                            $v.register.password_confirmation
                                                .$model
                                        "
                                        :class="{
                                            'is-invalid':
                                                $v.register
                                                    .password_confirmation
                                                    .$error
                                        }"
                                        required
                                        placeholder="Powtórz hasło"
                                        autocomplete="new-password"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            !$v.register.password_confirmation
                                                .sameAsPassword
                                        "
                                    >
                                        Hasła muszą się zgadzać.
                                    </div>
                                </div>
                            </div>
                            <div v-if="errMessage" class="">
                                {{ errMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <button
                                class="btn btn-center btn-primary"
                                @click="send"
                                :disabled="this.$v.$invalid"
                            >
                                Zarejestruj się
                            </button>
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
export default {
    data() {
        return {
            register: {
                role: 1,
                fname: null,
                lname: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errCode: null,
            errMessage: ""
        };
    },
    validations: {
        register: {
            fname: {
                required,
                minLength: minLength(3)
            },
            lname: {
                required,
                minLength: minLength(3)
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(8)
            },
            password_confirmation: {
                sameAsPassword: sameAs("password")
            }
        }
    },
    methods: {
        send: function async() {
            if (!this.$v.$invalid) {
                axios
                    .post("/api/register", this.register)
                    .catch(err => {
                        console.log(err.response);
                        this.errCode = err.response.status;
                        this.errMessage = Object.values(
                            err.response.data.errors
                        )[0][0];
                    })
                    .then(res => {
                        console.log(res.data);
                        this.$router.push("/login");
                    });
            }
        },

        setRole: function(role) {
            this.register.role = role;
        },

        setColor: function(roles) {
            if (this.register.role == roles) {
                return "background: #0061c9";
            } else return "";
        }
    }
};
</script>
<style scoped>
input {
    width: 60%;
    margin-bottom: 1.1rem;
    margin-left: auto;
    margin-right: auto;
}

.head {
    display: grid;
    width: 60%;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 0fr;
    grid-gap: 1.1rem;
    margin-left: auto;
    margin-right: auto;
}

.head-form {
    width: 100%;
    margin-bottom: 0;
}

.head-name {
    font-size: 23px;
}

.btn-center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0;
}

.roles {
    padding: 6px;
    width: 7rem;
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    vertical-align: middle;
    font-size: 14px;
    cursor: pointer;
    background: rgb(25, 25, 25);
}

.roles2 {
    display: flex;
    justify-content: center;
}

.roles:hover {
    background: rgb(29, 29, 29);
}
</style>
