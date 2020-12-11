<template>
    <div>
        <nav id="nav">
            <div class="top-left">
                <a href="/">ipies</a>
            </div>
            <div class="top-right links">
                <ul>
                    <span class="dropdown-display">

                            <li v-if="!$store.state.user || $store.state.user.role == 1 ">
                                <a class="dropdown-item" @click="$router.push('/losowanie40')">Losuj 40 pytań</a>
                            </li>


                            <li v-if="!$store.state.user || $store.state.user.role == 1 ">
                                <a class="dropdown-item" @click="$router.push('/losowanie1')">Losuj 1 pytanie</a>
                            </li>

                        <user-menu @get-user="getUser" />
                    </span>
                </ul>
            </div>
        </nav>
        <div class="my-content">
            <router-view @get-user="getUser"></router-view>
        </div>
        <footer class="footer">
            <p>| Strona internetowa ipies | no copyright 2020</p>
        </footer>
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
.dropdown-item{
    cursor:pointer;
}
.footer > p {
    padding:0;
    margin:0;
}
.footer {
    margin:0;
    padding:0;
    display:flex;
    justify-content: center;
    align-items: center;
    clear: both;
    color: #fcfcfc;
    height: 2rem;
    text-align: center;
    text-transform: uppercase;
}
    router-link {
        cursor: pointer;
    }
</style>
