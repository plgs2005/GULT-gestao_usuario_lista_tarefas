import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../vuex/store'


import AdminComponent from '../components/admin/AdminComponent'
import tasksComponents from '../components/admin/pages/tasks/tasksComponents'
import AddTaskComponent from '../components/admin/pages/tasks/AddTaskComponent'
import statusComponent from '../components/admin/pages/status/statusComponents'
import AddStatusComponent from '../components/admin/pages/status/AddStatusComponent'

import EditStatusComponent from '../components/admin/pages/status/EditStatusComponent'
import EditTasksComponent from '../components/admin/pages/tasks/EditTasksComponent'


import DashboardComponent from '../components/admin/pages/dashboard/DashboardComponent'

import HomeComponent from '../components/frontend/pages/home/HomeComponent'
import LoginComponent from '../components/frontend/pages/login/LoginComponent'
import SiteComponent from '../components/frontend/SiteComponent'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: SiteComponent,
    children:[
      { path: 'login', component: LoginComponent, name: 'login', meta:{ auth: false } },
      { path: '', component: HomeComponent, name: 'home' },
    ]
  },
  {
    path: '/admin',
    component: AdminComponent,
    meta:{auth: true},
    children: [
      { path: '', component: DashboardComponent, name: 'admin.dashboard' ,  },
      { path: 'tasks', component: tasksComponents, name: 'admin.tasks' , },
      { path: 'tasks/create', component: AddTaskComponent, name: 'admin.tasks.create' ,  },
      { path: 'tasks/:id/edit', component: EditTasksComponent, name: 'admin.tasks.edit', props: true,   },

      { path: 'status', component: statusComponent, name: 'admin.status' , },
      { path: 'status/create', component: AddStatusComponent, name: 'admin.status.create',  },
      { path: 'status/:id/edit', component: EditStatusComponent, name: 'admin.status.edit', props: true,  }
    ]

  },

]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next)=>{
   if(to.meta.auth && !store.state.Auth.authenticated){
     store.commit('CHANGE_URL_BACK', to.name)
     return router.push({name: 'login'})
   }
   if(to.matched.some(record => record.meta.auth ) && !store.state.Auth.authenticated){
    store.commit('CHANGE_URL_BACK', to.name)
    return router.push({name: 'login'})
   }
   if(to.meta.hasOwnProperty('auth') && !to.meta.auth && store.state.Auth.authenticated){
    return router.push({name: 'admin.dashboard'})
   }
  next()
})

export default router