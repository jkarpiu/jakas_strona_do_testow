<template>
    <div>
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
                        <li><a class="dropdown-item">Losuj 40 pytań</a></li>
                        <li><a class="dropdown-item">Losuj 1 pytanie</a></li>


                        <li>
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                v-pre
                            >
                            </a>

                            <ul>
                                <a
                                    class="dropdown-item"
                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();"
                                >
                                    Wyloguj się
                                </a>
                            </ul>

                            <form
                                id="logout-form"
                                action=""
                                method="POST"
                                class="d-none"
                            >
                            </form>
                        </li>
                    </span>
                </ul>
            </div>

        </nav>
        <div class="my-content">
        <router-view></router-view></div>
    </div>
</template>
<script>
export default {};
</script>
