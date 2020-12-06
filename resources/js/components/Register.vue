<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="head-name">Rejestracja</div>                             
                                    <div class="form-group row">
                                            <span class="form-check">
                                                <div                                           
                                                    @click="setRole(1)"                                                                              
                                                    id="role1"                                                                                                     
                                                > 
                                                    Uczeń
                                                </div>                                               
                                                                                                   
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
                                <div class="form-group">
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
                                            
                                            <div class="form-group">                            
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

    input {
        width: 60%;
        margin-bottom: 1.5rem;
        margin-left: auto;
        margin-right: auto;
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

    #role1, #role2  {
        padding: 6px;
        width: 7rem;
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        background: rgb(25, 25, 25);
    }

    #role1:hover {
        background: rgb(29, 29, 29);
        color: rgb(148, 148, 148);
        
    }

    #role2:hover {
        background: rgb(29, 29, 29);
        color: rgb(148, 148, 148);
        
}
</style>
