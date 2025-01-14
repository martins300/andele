<template>
  <div>
    <table class="table">
      <tbody>
      <tr v-for="character in characters" :key="character.id">
        <td
            class="name right"
            v-if="character.id % 2 == 1"
            @click="goToCharacter(character.id)"
        >
          {{ character.name }}
        </td>
        <td>
          <img
              :src="character.image"
              class="character"
              :alt="character.name"
              @click="goToCharacter(character.id)"
          >
        </td>
        <td
            class="name left"
            v-if="character.id % 2 == 0"
            @click="goToCharacter(character.id)"
        >
          {{ character.name }}
        </td>
      </tr>
      </tbody>
    </table>
    <div v-if="loading" class="loading">
      Loading some more characters...
    </div>
    <div v-if="errormsg" class="error">
      {{ errormsg }}
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import {config}  from '../config.js';
import axios from 'axios';

export default {
  setup() {
    const characters = ref([]);
    const loading = ref(false);
    const errormsg = ref('');
    let page = ref(1);
    let observer;

    const fetchCharacters = async () => {
      loading.value = true;
      try {
        const response = await axios.get(config.$api_url+`/api/list`);
        if (response.data.results.length > 0) {
          characters.value.push(...response.data.results);
          page.value++;
        }
      } catch (error) {
        console.error(error);
        errormsg.value=error.message;
      } finally {
        loading.value = false;
      }
    };

    const handleScroll = () => {
      const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrolledFromTop = window.scrollY;

      if (scrollableHeight - scrolledFromTop < 100 && !loading.value) {
        fetchCharacters();
      }
    };

    onMounted(() => {
      fetchCharacters();
      window.addEventListener('scroll', handleScroll);
    });

    onBeforeUnmount(() => {
      window.removeEventListener('scroll', handleScroll);
    });

    return {
      characters,
      loading,
      errormsg,
    };
  },

  methods: {
    goToCharacter(id) {
      this.$router.push('/character/'+id)
    },
  },
};
</script>

<style>
.loading {
  text-align: center;
  margin-top: 10px;
}
.error {
  text-align: center;
  margin-top: 10px;
  background-color: #dc9e9e;
}
.character {
    margin-top: 10px;
    min-height: 200px;
    cursor:pointer;
}
.name {
    font-size: xx-large;
    padding: 10px;
    cursor:pointer;
}
.right {
    text-align: right;
}
.left {
    text-align: left;
}
</style>