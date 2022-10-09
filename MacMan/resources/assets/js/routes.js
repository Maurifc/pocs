import LoginForm from './components/LoginForm.vue';
import Computadores from './components/Computadores.vue';
import Licencas from './components/Licencas.vue';
import Clientes from './components/Clientes.vue';

const routes = [
  {
    path: '/',
    component: LoginForm,
    //Somente quem está deslogado tem acesso ao form de login
    meta: {permission: 'any', fail: '/computadores'}
  },
  {
    path: '/computadores',
    component: Computadores,
    meta: {permission: 'admin', fail: '/'}
  },
  {
    path: '/licencas',
    component: Licencas,
    meta: {permission: 'admin', fail: '/'}
  },
  {
    path: '/clientes',
    component: Clientes,
    meta: {permission: 'admin', fail: '/'}
  }
]

export default routes;
