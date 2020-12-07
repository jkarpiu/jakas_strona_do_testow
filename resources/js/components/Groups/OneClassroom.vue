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
            <div class="addpost" v-if="$store.state.user && $store.state.user.role == 2" style="display: flex; flex-direction: column;">
              <div class="dodawanie" style="margin-left:2.5vw;"> 
                    <div class="form active-dodawanie">
                        <textarea 
                        class="tekst form-control" 
                        rows="1"
                        name=""
                        id=""
                        v-model="newTitle"
                        style="width: 45vw;"
                        ></textarea>
                        <label>Tytuł</label>

                        <textarea 
                        class="tekst form-control" 
                        rows="3"
                        name=""
                        id=""
                        v-model="newPost"
                        style="width: 45vw;"
                        ></textarea>
                         <label>Treść</label>
                    </div>
              </div>
                </div>
            <div class="przycisk">
                <button class="btn btn-primary" @click="addPost">
                    Dodaj post
                </button>
            </div>

            <div class="post" :key="post.id" v-for="post in posts">
                <p class="post_tytul">Tytuł: {{ post.author.fname }}</p>
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
    grid-template-rows: 0.10fr 1fr;
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
    padding: 1.5px 0.5vw 1vw 0.7vw;
    margin-left:10vw;
    width:50vw;
    background: rgb(39, 39, 39);
    margin-bottom: 3rem;
    box-shadow: 5px 3px 16px 0px rgba(0,0,0,0.5);
    
}
.przycisk{
    margin-left:10vw;
}
.addpost {
    padding-bottom:1rem;
    padding-top:2rem;
    background: rgb(39, 39, 39);
    margin-left:10vw;
    width:50vw;
    box-shadow: 10px 6px 24px 0px rgba(0,0,0,0.5);
}
textarea{
    resize: none;
}

.dodawanie textarea.tekst:focus:not([readonly]) {
  border-bottom: 2px solid #509df0;
  box-shadow: 0 1px 0 0 #81a7cf;
}
.active-dodawanie.form label.active {
  color: #81a7cf;
}
.active-dodawanie.form textarea.tekst:focus:not([readonly])+label {
  color: #81a7cf;
}

.post_tytul{
    border-bottom: 1px dotted white;
    font-size: 1.3rem;
    color: #81a7cf;
}

</style>
