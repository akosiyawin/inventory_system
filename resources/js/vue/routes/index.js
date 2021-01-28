import NotFound from "../NotFound.vue";
import Dashboard from '../components/Dashboard.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Inventory from "../components/Inventory";
import CreateProduct from "../components/CreateProduct";
import CreateCategory from "../components/CreateCategory";
export default {
    mode: 'history',
    linkActiveClass: 'text-primary font-weight-bold',
    routes: [
        {
            path: '*',
            component: NotFound,
            meta: {
                middleware: {
                    auth: false
                }
            }
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'dashboard',
            meta: {
                middleware: {
                    auth: true
                }
            }
        },
        {
            path: '/inventory',
            component: Inventory,
            name: 'inventory',
            meta: {
                middleware: {
                    auth: true
                }
            }
        },
        {
            path: '/create-product',
            component: CreateProduct,
            name: 'create',
            meta: {
                middleware: {
                    auth: true
                }
            }
        },
        {
            path: '/create-category',
            component: CreateCategory,
            name: 'category',
            meta: {
                middleware: {
                    auth: true
                }
            }
        },
        {
            path: '/login',
            component: Login,
            name: 'login',
            meta: {
                middleware: {
                    auth: false
                }
            }
        },
      /*  {
            path: '/register',
            component: Register,
            name: 'register',
            meta: {
                middleware: {
                    auth: false
                }
            }
        },*/
    ]
};
