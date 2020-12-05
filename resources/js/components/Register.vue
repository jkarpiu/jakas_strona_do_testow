<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div>Rejestracja</div>
                            <div class="form-group row">
                                <div>
                                    <span class="form-check">
                                        <div
                                            class="form-check-input"
                                            @click="setRole(1)"                                                                              
                                            id="role1"
                                            value="1"
                                            
                                        >  
                                        </div>
                                        <label
                                            class="form-check-label"
                                            for="role1"
                                        >
                                            Uczeń
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <div                                                                                                                 
                                            @click="setRole(2)"
                                            id="role2"                                           
                                        > 
                                            Nauczyciel
                                        </div>
                                            
                                        
                                    </span>
                                </div>
                            </div>    
                            <div class="form-group row">                               
                                <div>
                                    <input
                                        id="fname"
                                        type="text"
                                        class="form-control @error('fname') is-invalid @enderror"
                                        v-model="register.fname"
                                        required
                                        placeholder="Podaj imię"
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
                                <div>
                                    <input
                                        id="lname"
                                        type="text"
                                        class="form-control @error('lname') is-invalid @enderror"
                                        v-model="register.lname"
                                        required
                                        placeholder="Podaj nazwisko"
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
                                <div>
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        v-model="register.email"
                                        required
                                        placeholder="Podaj adres e-mail"
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
                                <div>
                                    <input
                                        id="password"
                                        v-model="register.password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        required
                                        placeholder="Podaj hasło"
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
                                <div>
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        v-model="register.password_confirmation"
                                        required
                                        placeholder="Powtórz hasło"
                                        autocomplete="new-password"
                                    />
                                </div>
                            </div>
                        
                            <div class="form-group row mb-0">
                                <div class="offset-md-4">
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
        },

        setRole: function(role) {
            this.register.role=role;
        }
    }
};
</script>
<style scoped>
    .form-check {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    input {
        width: 60%;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }


  
</style>
