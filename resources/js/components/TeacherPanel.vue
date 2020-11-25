<template>
  <div>
    <home v-if="state == 0" />
  </div>
</template>

<script lang="ts">
import Home from "./TeacherPanel/Home.vue";
import axios from "axios";
export default {
  components: { Home },

  methods: {},
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