<template>
    <div>
        <nav id="nav">
            <div class="top-left">
                <a href="/">ipies</a>
            </div>
            <div class="top-right links">
                <ul>
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
                        <user-menu @get-user="getUser" />
                    </span>
                </ul>
            </div>
        </nav>
        <div class="my-content">
            <router-view @get-user="getUser"></router-view>
        </div>
        <div class="page-footer footer">
            <p>Stroneczka egzaminki no copyrights</p>
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
    created() {
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
                    this.$store.commit('setUser', null);
                })
                .then(res => {
                    console.log(res);
                    let userData = res.data
                    this.$store.commit('setUser', userData);
                });
        }
    }
};
</script>
<style>
.footer {
    clear: both;
    color: #fcfcfc;
    display: block;
    height: 0.5vh;
    margin-top: 1vh;
    text-align: center;
    text-transform: uppercase;
}
    router-link {
        cursor: pointer;
    }
</style>
