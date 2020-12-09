<template>
    <div id="classroomView">
        <div class="toolbox">
            <button
                v-if="$store.state.user != null && $store.state.user.role == 2"
                class="btn btn-primary"
                style= "margin:2vh;"
                @click="getInvitation"
            >
                <span v-if="!isInvitationLoading"
                    ><font-awesome-icon icon="link" /> Zaproś
                </span>
                <p v-else>Tworzenie Zaproszenia</p>
            </button>
        </div>
        <div id="mainView">
            <div class="addPost" v-if="$store.state.user && $store.state.user.role == 2">
                <h2 style="margin-left:10vw;">Tworzenie posta</h2>
                <div
                    class="addpost"

                    style="display: flex; flex-direction: column"
                >
                    <div class="dodawanie" style="margin-left: 1.25vw;">
                        <div class="form active-dodawanie">
                            <textarea
                                class="tekst form-control"
                                rows="1"
                                name=""
                                id=""
                                v-model="title"
                                style="width: 47.5vw"
                            ></textarea>
                            <label>Tytuł</label>
                            <div class="editor">
                                <editor-menu-bar
                                    :editor="editor"
                                    v-slot="{ commands, isActive }"
                                >
                                    <div class="menubar">
                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.bold()
                                            }"
                                            @click="commands.bold"
                                        >
                                            <font-awesome-icon icon="bold" />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.italic()
                                            }"
                                            @click="commands.italic"
                                        >
                                            <font-awesome-icon icon="italic" />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.strike()
                                            }"
                                            @click="commands.strike"
                                        >
                                            <font-awesome-icon
                                                icon="strikethrough"
                                            />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.underline()
                                            }"
                                            @click="commands.underline"
                                        >
                                            <font-awesome-icon
                                                icon="underline"
                                            />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.code()
                                            }"
                                            @click="commands.code"
                                        >
                                            <font-awesome-icon icon="code" />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.heading({
                                                    level: 1
                                                })
                                            }"
                                            @click="
                                                commands.heading({ level: 1 })
                                            "
                                        >
                                            H1
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.heading({
                                                    level: 2
                                                })
                                            }"
                                            @click="
                                                commands.heading({ level: 2 })
                                            "
                                        >
                                            H2
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.heading({
                                                    level: 3
                                                })
                                            }"
                                            @click="
                                                commands.heading({ level: 3 })
                                            "
                                        >
                                            H3
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.bullet_list()
                                            }"
                                            @click="commands.bullet_list"
                                        >
                                            <font-awesome-icon icon="list-ul" />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.ordered_list()
                                            }"
                                            @click="commands.ordered_list"
                                        >
                                            <font-awesome-icon icon="list-ol" />
                                        </button>

                                        <button
                                            class="menubar__button"
                                            :class="{
                                                'is-active': isActive.code_block()
                                            }"
                                            @click="commands.code_block"
                                        >
                                            <font-awesome-icon icon="code" />
                                        </button>

                                        <button
                                            class="menubar__button history_button"
                                            @click="commands.undo"
                                        >
                                            <font-awesome-icon icon="undo" />
                                        </button>

                                        <button
                                            class="menubar__button history_button"
                                            @click="commands.redo"
                                        >
                                            <font-awesome-icon icon="redo" />
                                        </button>
                                    </div>
                                </editor-menu-bar>

                                <editor-content
                                    class="editor__content"
                                    :editor="editor"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="przycisk">
                    <button class="btn btn-primary" 
                    style= "margin-top:1vh; margin-bottom:4vh;"
                    @click="addPost">
                        Dodaj post
                    </button>
                </div>
            </div>
            <h2 style="margin-left:10vw;">Posty</h2>
            <div class="post" :key="post.id" v-for="post in posts">
                <p class="post_tytul">{{ post.title }}</p>
                <div class="post_tresc">
                    <p style="margin-bottom: 3rem" v-html="post.content"></p>
                    <i
                        ><p style="text-align: right; font-size: 0.7rem">
                            {{ sensownyCzas(post.created_at) }}
                        </p></i
                    >
                </div>
                <div
                    class="komentarze"
                    style="margin-left: 2vw"
                    :key="comment.id"
                    v-for="comment in post.comments"
                >
                    <div
                        style="display:inline-block; align-items: center; margin-right:0.5vh;"
                    >
                        <font-awesome-icon
                            icon="user"
                            style="font-size:1.5rem;"
                        />
                    </div>
                    <p
                        style="display: inline-block; padding:1px; margin-bottom:0; margin-bottom:0; color:cadetblue;"
                    >
                        AUTOR
                    </p>
                    <p
                        style="display: inline-block; float: right; font-size: 0.6rem"
                    >
                        2020-21-37
                    </p>
                    <p
                        style="margin-left: 5px; margin-right: 5px; margin-bottom:0;"
                    >
                        {{ comment.tresc }}
                    </p>
                </div>
                <div class="dodawanie" style="margin-left: 0.2vw;">
                    <div
                        class="form active-dodawanie"
                        style="display:flex; margin-top:4vh; padding-bottom:0.7vh;"
                    >
                        <div
                            style="display:flex; justify-content:center; align-items: center; margin-right:0.7vh;"
                        >
                            <font-awesome-icon
                                icon="user"
                                style="font-size:2rem;"
                            />
                        </div>
                        <textarea
                            class="tekst form-control"
                            rows="1"
                            name=""
                            id=""
                            v-model="comment[post.id]"
                            style="width: 27.7vw; margin-right:0.5vh;"
                        ></textarea>

                        <button
                            class="btn btn-primary"
                            style="margin: 0 !important; min-width: 2vw; display: inline-block"
                            @click="addComment(post.id)"
                        >
                            >
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <modal
            v-if="$store.state.user != null && $store.state.user.role == 2"
            name="invitation"
            styles="background-color: #191919; padding: 25px;"
            adaptive
        >
            <div v-if="invitation">
                <p>Kod: {{ invitation.code }}</p>
                <p>Termin Ważności: {{ new Date(invitation.expire_date) }}</p>
            </div>
        </modal>
    </div>
</template>
<script>
import { Editor, EditorContent, EditorMenuBar } from "tiptap";
import {
    BulletList,
    CodeBlock,
    Heading,
    ListItem,
    OrderedList,
    Link,
    Bold,
    Code,
    Italic,
    Strike,
    Underline,
    History
} from "tiptap-extensions";
import axios from "axios";

export default {
    props: ["id"],
    data() {
        return {
            invitation: null,
            isInvitationLoading: false,
            newPost: "",
            title: "",
            posts: [],
            comment: [],
            editor: new Editor({
                extensions: [
                    new BulletList(),
                    new CodeBlock(),
                    new Heading({ levels: [1, 2, 3] }),
                    new ListItem(),
                    new OrderedList(),
                    new Link(),
                    new Bold(),
                    new Code(),
                    new Italic(),
                    new Strike(),
                    new Underline(),
                    new History()
                ]
            })
        };
    },
    created() {
        console.log(this.id);
        this.listPosts();
    },
    components: {
        EditorMenuBar,
        EditorContent
    },
    methods: {
        sensownyCzas: function(sqlTime) {
            let date = new Date(sqlTime);
            let miesiace = [
                "stycznia",
                "lutego",
                "marca",
                "kwietnia",
                "maja",
                "czerwca",
                "lipca",
                "sierpnia",
                "września",
                "października",
                "listopada",
                "grudnia"
            ];
            return (
                date.getDate().toString() +
                " " +
                miesiace[parseInt(date.getMonth())] +
                " " +
                date.getFullYear() +
                " " +
                date.getHours() +
                ":" +
                date.getMinutes()
            );
        },
        listPosts: function() {
            axios
                .post("/api/list_posts", { id: this.id })
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    console.log(res.data);
                    this.posts = res.data;
                });
        },
        addPost: function() {
            this.newPost = this.editor.getHTML();
            axios
                .post("/api/add_post", {
                    id: this.id,
                    content: this.newPost,
                    title: this.title
                })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    this.listPosts();
                    this.editor.clearContent();
                    this.title = "";
                });
        },
        addComment: function(id) {
            axios
                .post("/api/add_comment", {
                    tresc: this.comment[id],
                    post_id: id
                })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    this.listPosts();
                    this.comment[id] = "";
                });
        },
        getInvitation: function() {
            this.isInvitationLoading = true;
            axios
                .post("/api/invitation", { id: this.id })
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    console.log(res);
                    this.invitation = res.data;
                    this.isInvitationLoading = false;
                    this.$modal.show("invitation");
                });
        }
    }
};
</script>
<style scoped>
#classroomView {
    display: grid;
    grid-template-rows: 0.03fr 1fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
    height: 10vh;
}
#mainView {
    display: flex;
    flex-direction: column;
}
.post {
    padding: 0.4vw 0.7vw 0.7vw 0.7vw;
    margin-left: 10vw;
    width: 50vw;
    background: rgb(39, 39, 39);
    margin-bottom: 3rem;
    box-shadow: 5px 3px 16px 0px rgba(0, 0, 0, 0.5);
}
.przycisk {
    margin-left: 10vw;
}
.addpost {
    padding-bottom: 1vh;
    padding-top: 2.5vh;
    background: rgb(39, 39, 39);
    margin-left: 10vw;
    width: 50vw;
    box-shadow: 10px 6px 24px 0px rgba(0, 0, 0, 0.5);
}
.komentarze {
    border-bottom: 2px solid #509df0;
    box-shadow: 0 1px 0 0 #81a7cf;
    background: rgb(66, 66, 66);
    width: 30vw;
    max-width: 30vw;
    padding: 5px 5px 8px 5px;
    word-wrap: break-word;
    min-height: 2rem;
    margin-bottom: 1.5vh;
}
textarea {
    resize: none;
}

.dodawanie textarea.tekst:focus:not([readonly]) {
    border-bottom: 2px solid #509df0;
    box-shadow: 0 1px 0 0 #81a7cf;
}
.active-dodawanie.form label.active {
    color: #81a7cf;
}
.active-dodawanie.form textarea.tekst:focus:not([readonly]) + label {
    color: #81a7cf;
}

.post_tytul {
    border-bottom: 1px dotted white;
    font-size: 1.3rem;
    color: #81a7cf;
}
.editor {
    position: relative;
    width: 47.5vw;
    color: black;
    background: white;
}

.editor__content {
    padding: 2px 2px 0px 2px;
    min-height: 3rem;
}
.menubar {
    margin-right: auto;
    margin-left: auto;
    background: rgb(224, 224, 224);
    padding: 5px;
}

.menubar__button {
    border: hidden;
    border-radius: 5px;
    box-shadow: none;
    background: rgb(224, 224, 224);
}

.is-active {
    background: #0061c9;
}

strong{
    font-weight: 800 !important;
}
</style>
