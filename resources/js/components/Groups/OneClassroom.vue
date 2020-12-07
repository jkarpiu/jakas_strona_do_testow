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
      <div
        class="addpost"
        v-if="$store.state.user && $store.state.user.role == 2"
        style="display: flex; flex-direction: column"
      >
        <div class="dodawanie" style="margin-left: 2.5vw">
          <div class="form active-dodawanie">
            <textarea
              class="tekst form-control"
              rows="1"
              name=""
              id=""
              v-model="title"
              style="width: 45vw"
            ></textarea>
            <label>Tytuł</label>
            <textarea
              class="tekst form-control"
              rows="3"
              name=""
              id=""
              v-model="newPost"
              style="width: 45vw"
            ></textarea>
            <label>Treść</label>
          </div>
        </div>
      </div>
      <div class="przycisk">
        <button class="btn btn-primary" @click="addPost">Dodaj post</button>
      </div>

      <div class="post" :key="post.id" v-for="post in posts">
        <p class="post_tytul">{{ post.title }}</p>
        <p style="margin-bottom:3rem;">{{ post.content }}</p>
        <i><p style="text-align: right; font-size:0.7rem;">{{ sensownyCzas(post.created_at) }}</p></i>
        <div
          class="komentarze"
          style="margin-left: 2vw;"
          :key="comment.id"
          v-for="comment in post.comments"
        >
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStixxgmXCRq9V0b8G85MJ0cTj1pT1AYOuoKg&usqp=CAU" style="width:2rem; margin-right:0.5vw; display:inline-block;">
          <p style="display:inline-block;">AUTOR</p> 
          <p style="display:inline-block; float: right; font-size:0.6rem;">2020-21-37</p>
          <p style="margin-left:5px; margin-right:5px;">{{ comment.tresc }}</p>
          
        </div>
        <div class="dodawanie" style="margin-left: 2.5vw;">
          <div class="form active-dodawanie">
            
              <textarea
                class="tekst form-control"
                rows="1"
                name=""
                id=""
                v-model="comment[post.id]"
                style="width: 20vw; display:inline-block;"
              ></textarea>
              
            
            <button
              class="btn btn-primary"
              style="margin: 0 !important; width: 2vw; display:inline-block;"
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
    };
  },
  created() {
    console.log(this.id);
    this.listPosts();
  },
  methods: {
    sensownyCzas: function (sqlTime) {
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
        "grudnia",
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
    listPosts: function () {
      axios
        .post("/api/list_posts", { id: this.id })
        .catch((err) => {
          console.log(err.response);
        })
        .then((res) => {
          console.log(res.data);
          this.posts = res.data;
        });
    },
    addPost: function () {
      axios
        .post("/api/add_post", {
          id: this.id,
          content: this.newPost,
          title: this.title,
        })
        .catch((err) => console.log(err.response))
        .then((res) => {
          console.log(res.data);
          this.listPosts();
        });
    },
    addComment: function (id) {
      axios
        .post("/api/add_comment", { tresc: this.comment[id], post_id: id })
        .catch((err) => console.log(err.response))
        .then((res) => {
          console.log(res.data);
          this.listPosts();
        });
    },
    getInvitation: function () {
      this.isInvitationLoading = true;
      axios
        .post("/api/invitation", { id: this.id })
        .catch((err) => {
          console.log(err.response);
        })
        .then((res) => {
          console.log(res);
          this.invitation = res.data;
          this.isInvitationLoading = false;
          this.$modal.show("invitation");
        });
    },
  },
};
</script>
<style scoped>
#classroomView {
  display: grid;
  grid-template-rows: 0.1fr 1fr;
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
  padding-bottom: 1rem;
  padding-top: 2rem;
  background: rgb(39, 39, 39);
  margin-left: 10vw;
  width: 50vw;
  box-shadow: 10px 6px 24px 0px rgba(0, 0, 0, 0.5);
}
.komentarze {
  background: rgb(66, 66, 66);
  width: 30vw;
  max-width:30vw;
  padding: 5px 5px 2px 5px;
  word-wrap: break-word;
  min-height: 2rem;
  margin-bottom: 2vh;
  
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
</style>
