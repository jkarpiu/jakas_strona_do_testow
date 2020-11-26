<template>
  <div>
    <home @page-change="pageChange" v-if="state == 0" />
    <classrooms v-if="state == 1" />
  </div>
</template>

<script lang="ts">
import Home from "./TeacherPanel/Home.vue";
import Classrooms from "./TeacherPanel/Classrooms.vue";
import axios from "axios";
export default {
  components: { Home, Classrooms },

  methods: {
    pageChange: function(state:Number) {
      this.state = state
    }
  },
  data() {
    return {
      state: 0,
    };
  },
  mounted(): any {
    axios.get("/auth_api/classrooms")
      .catch((err) => {console.log(err);})
      .then((res:any) => {
        console.log(res.data);
      });
  },
};
</script>>