<template>
    <span>
        <!-- @if (Auth::user())
                        @if (Auth::user()->role == 0)
                            <li> <a class="dropdown-item panel" href="">Panel ucznia</a> </li>
                        @else
                <li> <a class="dropdown-item panel" href="{{route('teacherPanel')}}">Panel nauczyciela</a> </li>
                        @endif
                    @endif -->
        <span v-if="!user">
            <router-link to="login">
                <li><a class="dropdown-item">Zaloguj się</a></li></router-link
            >
            <router-link to="register">
                <li>
                    <a class="dropdown-item">Zarejestruj się</a>
                </li></router-link
            >
        </span>
        <span v-else>
            <li>
                <a
                    id="navbarDropdown"
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{ user.fname }}
                </a>

                <ul>
                    <a class="dropdown-item" @click="logout">
                        Wyloguj się
                    </a>
                </ul>
                <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                </form> -->
            </li>
        </span>
    </span>
</template>
<script>
import axios from "axios";
export default {
    props: ["user"],
    methods: {
        logout: function() {
            axios
                .get("/api/logout")
                .catch(err => {
                    console.log(err);
                })
                .then(res => {
                    this.$emit("get-user");
                });
        }
    }
};
</script>
