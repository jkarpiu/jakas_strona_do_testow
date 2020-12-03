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
            <router-link to="/login">
                <li><a class="dropdown-item">Zaloguj się</a></li></router-link
            >
            <router-link to="/register">
                <li>
                    <a class="dropdown-item">Zarejestruj się</a>
                </li></router-link
            >
        </span>
        <span v-else>
            <router-link to="/teacher" v-if="user.role == 2">
                <li>
                    <a class="dropdown-item panel">Panel nauczyciela</a>
                </li></router-link
            >
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

                <ul v-if="$store.state.user.role == 1">
                    <a
                        class="dropdown-item"
                        @click="$router.push('/user/wyniki')"
                        style="cursor: pointer;"
                    >
                        Moje Wyniki
                    </a>
                </ul>
                <ul>
                    <a
                        class="dropdown-item"
                        @click="logout"
                        style="cursor: pointer;"
                    >
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
    computed: {
        user: function() {
            return this.$store.state.user;
        }
    },
    methods: {
        logout: function() {
            axios
                .get("/api/logout")
                .catch(err => {
                    console.log(err);
                })
                .then(res => {
                    this.$emit("get-user");
                    $router.push("/");
                });
        }
    }
};
</script>
<style scoped>
ul {
    margin-left: auto;
    margin-right: auto;
    padding: 0;
}

li {
    line-height: 2.5rem;
    float: left;
    text-align: center;
    color: black;
    margin: 0;
    list-style-type: none;
    width: 200px;
}

span>li>ul {
    display: none;
}

 a {
    color: #fcfcfc;
    padding: 0 15px;
    font-size: 13px;
    font-weight: 500;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}

/* wyloguj */
span>li:hover>ul {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: stretch;
    align-content: stretch;
    background: #0061c9;
    position: relative;
    height: 2.5rem;
    z-index: 2;
}

span>li>ul:hover>a {
    opacity: 0.3;
}
</style>