<template>
  <div>
    <question ref="Question"
      :key="item.id"
      v-for="item in myQuestion"
      :zawartoscPytania="item"
    />
     <button class="btn btn-primary" @click="click">Wybierz</button> 
     <button class="btn btn-primary">Następne pytanie</button>
  </div>
</template>
<script>
import Question from "./Question";
import axios from "axios";
export default {
  methods:{
    click:function (){
      this.$refs.Question[0].sprawdzanie();
    }
  },
  components: {
    question: Question,
  },
  data() {
    return {
      myQuestion: [],
    };
  },
  created() {
    axios.get("/api/randQuestion", {params:{dzial:1}}).catch((error)=>{console.log(error)}).then((res) => {
      this.myQuestion = res.data;
      console.log(res);
    });
  },
};
</script>