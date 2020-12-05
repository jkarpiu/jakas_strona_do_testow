<template>
    <div id="classroomView">
        <div class="toolbox">
            <button
                v-if="$store.state.user != null && $store.state.user.role == 2"
                class="btn btn-primary"
                @click="getInvitation"
            >
                <span v-if="!isInvitationLoading"
                    ><font-awesome-icon icon="link" /> Zaproś
                </span>
                <p v-else>Tworzenie Zaproszenia</p>
            </button>
        </div>
        <div id="mainView">
            <div v-if="$store.state.user && $store.state.user.role == 2" style="display: flex; flex-direction: column;">
                <textarea
                    class="form-control"
                    name=""
                    style="width: 70vw;"
                    id=""
                    v-model="newPost"
                    rows="10"
                ></textarea>
                <button class="btn btn-blue" @click="addPost">
                    Dodaj post
                </button>
            </div>
            <div :key="post.id" v-for="post in posts">
                <p>Autor: {{ post.author.fname }}</p>
                <p>{{ post.content }}</p>
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
import axios from "axios";
export default {
    props: ["id"],
    data() {
        return {
            invitation: null,
            isInvitationLoading: false,
            newPost: "",
            posts: []
        };
    },
    created() {
        console.log(this.id);
        this.listPosts()
    },
    methods: {
        listPosts: function(){
            axios.post('/api/list_posts', {id: this.id})
                .catch((err)=>{console.log(err.response)})
                .then((res)=>{
                    console.log(res.data)
                    this.posts = res.data
                })
        },
        addPost: function() {
            axios
                .post("/api/add_post", { id: this.id, content: this.newPost })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    this.listPosts();
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
    grid-template-rows: 1fr 1fr;
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
</style>
