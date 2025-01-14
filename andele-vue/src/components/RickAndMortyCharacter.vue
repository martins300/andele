<template>
  <div>

    <a @click="router.go(-1)">Back to character list</a>

    <div v-if="!loading">
          <h2>About The Character (id:{{character.id}})</h2>

          <div class="name1">
            {{character.name}}
          </div>
          <div>
            {{character.species}}
          </div>
          <div>
            Status: {{character.status}}
          </div>
          <div>
            <img
                :src="character.image"
                class="character1"
                :alt="character.name"
            >
          </div>
    </div>

    <div v-if="loading" class="loading">
      Loading data...
    </div>
  </div>
</template>

<script setup>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
const router = useRouter();
</script>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import {useRoute} from "vue-router";
import {config}  from '../config.js';
import axios from 'axios';

const loading = ref(false);
const character = ref({});

export default {

  methods: {

    async fetchCharacter (id) {
      loading.value = true;
      try {
        const response = await axios.get(config.$api_url+`/api/character/${id}`);
        if (typeof response.data.id !== 'undefined') {
          character.value=response.data;
          console.log(response.data);
        }
      } catch (error) {
        console.error(error);
      } finally {
        loading.value = false;
      }
    }
  },

  beforeMount() {
    const route = useRoute();
    let id=route.params.id;
    this.fetchCharacter(id);
  },
};
</script>

<style>
a {
  cursor:pointer;
}
.loading {
  text-align: center;
  margin-top: 10px;
}
.character1 {
  margin-top: 10px;
  min-height: 200px;
}
.name1 {
  font-size: xx-large;
}
</style>