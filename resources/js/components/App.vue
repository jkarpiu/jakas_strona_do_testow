<template>
    <div>
        <input type="hidden" id="userID" :value="user ? user.id : null">
        <nav id="nav">
            <div class="top-left">
                <a href="/">ipies</a>
            </div>
            <div class="top-right links">
                <ul>
                    <!-- <span class="dropdown-display">
                        @if (Auth::user()) @if (Auth::user()->role == 0)
                        <li>
                            <a class="dropdown-item panel" href=""
                                >Panel ucznia</a
                            >
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item panel">Panel nauczyciela</a>
                        </li>
                        @endif @endif -->
                    <span class="dropdown-display">
                        <router-link to="/losowanie40">
                            <li>
                                <a class="dropdown-item">Losuj 40 pytań</a>
                            </li></router-link
                        >
                        <router-link to="/losowanie1">
                            <li>
                                <a class="dropdown-item">Losuj 1 pytanie</a>
                            </li></router-link
                        >
                        <user-menu :user="user" @get-user="getUser" />
                    </span>
                </ul>
            </div>
        </nav>
        <div class="my-content">
            <router-view @get-user="getUser"></router-view>
        </div>
    </div>
</template>
<script>
import axios from "axios";

import UserMenu from "./UserMenu";

export default {
    data() {
        return {
            user: null
        };
    },
    components: { UserMenu },
    mounted() {
        this.getUser();
    },
    methods: {
        getUser: function() {
            axios
                .get("/api/user", {
                    headers: {
                        Accept: "application/json",
                        "Content-type": "application/json"
                    }
                })
                .catch(err => {
                    console.log(err.response);
                    this.user = null;
                })
                .then(res => {
                    console.log(res);
                    this.user = res.data;
                });
        }
    }
};
</script>
