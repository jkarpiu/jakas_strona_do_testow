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
                                                    class="form-control head-form @error('fname') is-invalid @enderror"
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
                                                
                                            
                                            <input
                                                    id="lname"
                                                    type="text"
                                                    class="form-control head-form @error('lname') is-invalid @enderror"
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
                                    <div class="form-group">
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

                                    <div class="form-group">
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
                                
                                    <div class="form-group">       
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
                                </div>  
                                    <div class="form-group">
                                            <button
                                                class="btn btn-center btn-primary"
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
        },

        setColor: function(roles) {
            if(this.register.role==roles) {
                return "background: #0061c9";
            }
            else 
                return "";    
        },
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

 
    .head  {
        display: grid;
        width: 60%;
        grid-template-columns: 1fr 1fr; 
        grid-gap: 1.1rem;
        margin-left: auto;
        margin-right: auto;
    }

    .head-form {
        width: 100%;
        margin-bottom: 0;
    }

    .head-name  {
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
