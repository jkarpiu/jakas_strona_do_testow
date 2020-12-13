<template>
    <div>
        <nav id="nav">
            <div class="top-left">
                <a href="/">ipies</a>
            </div>
            <div class="top-right links">
                <ul>
                    <span class="dropdown-display">
                        <li
                            v-if="
                                !$store.state.user ||
                                    $store.state.user.role == 1
                            "
                        >
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Losuj 40 pytań
                            </a>

                            <ul>
                                <a
                                    class="dropdown-item"
                                    @click="$router.push('/losowanie40_ee08')"
                                    style="cursor: pointer;"
                                >
                                    EE.08
                                </a>
                            </ul>
                            <ul>
                                <a
                                    class="dropdown-item"
                                    @click="$router.push('/losowanie40_ee09')"
                                    style="cursor: pointer;"
                                >
                                    EE.09
                                </a>
                            </ul>
                            <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                </form> -->
                        </li>
<li
                            v-if="
                                !$store.state.user ||
                                    $store.state.user.role == 1
                            "
                        >
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Losuj 1 pytanie
                            </a>

                            <ul>
                                <a
                                    class="dropdown-item"
                                    @click="$router.push('/losowanie1_ee08')"
                                    style="cursor: pointer;"
                                >
                                    EE.08
                                </a>
                            </ul>
                            <ul>
                                <a
                                    class="dropdown-item"
                                    @click="$router.push('/losowanie1_ee09')"
                                    style="cursor: pointer;"
                                >
                                    EE.09
                                </a>
                            </ul>
                            <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                </form> -->
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
                    this.$store.commit("setUser", null);
                })
                .then(res => {
                    console.log(res);
                    let userData = res.data;
                    this.$store.commit("setUser", userData);
                });
        }
    }
};
</script>
<style>
.dropdown-item {
    cursor: pointer;
}
.footer > p {
    padding: 0;
    margin: 0;
}
.footer {
    margin: 0;
    padding: 0;
    display: flex;
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
