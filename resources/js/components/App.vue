<template>
    <div>
        <nav id="nav">
            <div class="top-left">
                <a href="/">ipies</a>
            </div>
            <div class="top-right links">
                <ul>
                    <span class="dropdown-display">
                        
                            <li>
                                <a class="dropdown-item" @click="$router.push('/losowanie40')">Losuj 40 pytań</a>
                            </li>
                        
                        
                            <li>
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
        <div class="page-footer footer">
            <p>| Strona internetowa ipies | no copyright 2020</p>
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
.dropdown-item{
    cursor:pointer;
}
.footer {
    margin:0;
    clear: both;
    color: #fcfcfc;
    display: block;
    height: 0.5vh;
    vertical-align: middle;
    text-align: center;
    text-transform: uppercase;
}
    router-link {
        cursor: pointer;
    }
</style>
