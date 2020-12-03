<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div>Rejestracja</div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <span class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            v-model="register.role"
                                            id="role1"
                                            value="1"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="role1"
                                        >
                                            Uczeń
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            v-model="register.role"
                                            id="role2"
                                            value="2"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="role2"
                                        >
                                            Nauczyciel
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="fname"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Imię</label
                                >

                                <div class="col-md-6">
                                    <input
                                        id="fname"
                                        type="text"
                                        class="form-control @error('fname') is-invalid @enderror"
                                        v-model="register.fname"
                                        required
                                        autocomplete="fname"
                                        autofocus
                                    />

                                    <!-- @error('fname')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="lname"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Nazwisko</label
                                >

                                <div class="col-md-6">
                                    <input
                                        id="lname"
                                        type="text"
                                        class="form-control @error('lname') is-invalid @enderror"
                                        v-model="register.lname"
                                        required
                                        autocomplete="lname"
                                        autofocus
                                    />

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
                                        class="form-control @error('email') is-invalid @enderror"
                                        v-model="register.email"
                                        required
                                        autocomplete="email"
                                    />

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

                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Hasło</label
                                >

                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        v-model="register.password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        required
                                        autocomplete="new-password"
                                    />

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

                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Potwierdź hasło</label
                                >

                                <div class="col-md-6">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        v-model="register.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        class="btn btn-primary"
                                        @click="send"
                                    >
                                        Zarejestruj się
                                    </button>
                                </div>
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
export default {
    data() {
        return {
            register: {
                role: null,
                fname: null,
                lname: null,
                email: null,
                password: null,
                password_confirmation: null
            }
        };
    },
    methods: {
        send: function async() {
            axios.post("/api/register", this.register).catch(err => {
                console.log(err.response);
            }).then((res)=>{
                console.log(res.data);
                this.$router.push('/login');
            });
        }
    }
};
</script>
