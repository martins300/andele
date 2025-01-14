import { createMemoryHistory, createRouter } from 'vue-router'

import ListView from "@/ListView.vue";
import CharacterView from "@/CharacterView.vue";

const routes = [
    { path: '/', component: ListView },
    { path: '/character/:id', component: CharacterView },
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router