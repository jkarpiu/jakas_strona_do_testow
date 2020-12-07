<template>
  <div>
    <div class="form-group row">
      <div class="col-md-6">
        <select
          name="schoolType"
          @change="getRegions()"
          v-model="type"
          class="form-control"
        >
          <option :key="option.id" v-for="option in types" :value="option.id">
            {{ option.name }}
          </option>
        </select>
      </div>
    </div>

    <div v-if="type != null" class="form-group row">
      <div class="col-md-6">
        <select
          name="region"
          @change="getCities()"
          v-model="region"
          class="form-control"
        >
          <option :key="option.id" v-for="option in regions" :value="option.id">
            {{ option.name }}
          </option>
        </select>
      </div>
    </div>

    <div v-if="region != null" class="form-group row">
      <div class="col-md-6">
        <select
          name="city"
          @change="getSchools()"
          v-model="city"
          class="form-control"
        >
          <option :key="option.id" v-for="option in cities" :value="option.id">
            {{ option.name }}
          </option>
        </select>
      </div>
    </div>

    <div v-if="city != null" class="form-group row">
      <div class="col-md-6">
        <select
          name="school"
          v-model="school"
          class="form-control"
        >
          <option :key="option.id" v-for="option in schools" :value="option.id">
            {{ option.name }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import axios from "axios";
let ctx;
export default {
  data() {
    return {
      types: [],
      regions: [],
      cities: [],
      schools: [],
      type: null,
      region: null,
      city: null,
      school: null
    };
  },
  methods: {
    getData: function async(adress: string, attr: string) {
      return axios
        .get(adress, { params: { id: attr } })
        .catch((err) => {
          console.log(err.response);
        })
        .then((res: any) => {
          return res.data;
        });
    },
    getTypes: async () => {
      ctx.types = await ctx.getData("/api/basic/typy_szkol", "");
    },
    getRegions: async () => {
      if (ctx.type != null) {
        ctx.regions = await ctx.getData("/api/basic/wojewodztwa", "");
      }
    },
    getCities: async () => {
      if (ctx.region != null) {
        ctx.cities = await ctx.getData("/api/basic/miasta", ctx.region);
      }
    },
    getSchools: async () => {
      if (ctx.city != null) {
        console.log(ctx.city);
        ctx.schools = await ctx.getData("/api/basic/szkoly", ctx.city);
      }
    },
  },
  created(): void {
    ctx = this;
    this.getTypes();
  },
};
</script>
