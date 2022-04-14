import { createRouter, createWebHistory } from 'vue-router'
import home from '../components/home.vue'
import curated from '../components/curated.vue'
import trade from '../components/trade.vue'
import leaderboard from '../components/leaderboard.vue'

const routes = [
  {
    path: '/home',
    name: 'home',
    component: home
  },
  {
    path: '/trade',
    name: 'trade',
    component: trade
  },
  {
    path: '/curated',
    name: 'curated',
    component: curated
  },
  {
    path: '/leaderboard',
    name: 'leaderboard',
    component: leaderboard
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
