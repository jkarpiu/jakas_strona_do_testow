<template>
  <div>
    <question ref="Question"
      :key="item.id"
      v-for="item in myQuestion"
      :zawartoscPytania="item"
    />
     <button @click="click">Wybierz</button>  
  </div>
</template>
<script>
import Question from "./Question";
import axios from "axios";
export default {

  methods:{
    click:function (){
      this.$refs.Question.sprawdzanie();
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
    axios.get("/api/randQuestion").then((res) => {
      this.myQuestion = res.data;
    });
  },
};
</script>