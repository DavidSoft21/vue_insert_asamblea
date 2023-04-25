import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Persona from '../views/Persona.vue'
import Asamblea from '../views/Asamblea.vue'
import Formularios from '../views/Formularios.vue'
import Temarios from '../views/Temarios.vue'
import Opciones from '../views/Opciones.vue'
import OpcionesTemario from '../views/OpcionesTemario.vue'
import App from '../App.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },

    {
      path: '/persona',
      name: 'persona',
      component: Persona
    },
    {
      path: '/asamblea',
      name: 'asamblea',
      component: Asamblea
    },
    {
      path: '/formulario',
      name: 'formulario',
      component: Formularios
    },
    {
      path: '/temario',
      name: 'temario',
      component: Temarios
    },
    {
      path: '/opciones',
      name: 'opciones',
      component: Opciones
    },
    {
      path: '/opcion_temario',
      name: 'OpcionesTemario',
      component: OpcionesTemario
    },
    
  ]
})

export default router
