<template>
  <div>
    <question
      :key="item.id"
      v-for="item in myQuestion"
      :zawartoscPytania="item"
    />
  </div>
</template>
<script>
import Question from "./Question";
import axios from "axios";
export default {
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