import VueRouter from "vue-router";
import routes from "./";
import Api from "../tools/api";
import Vue from "vue";


Vue.use(VueRouter);

const router = new VueRouter(routes)
/*This is a way better for handling Middleware Auth*/
router.beforeEach((to, from, next) => {
    if (to.meta.middleware.auth) {
        Api.isLoggedIn()
            .then(r => {
                next()
            })
            .catch(err => {
                next({ name: 'login' })
            })
    } else if (to.meta.middleware.auth === undefined) {
        next()
    } else {
        Api.isLoggedIn()
            .then(r => {
                next({ name: 'dashboard' })
            })
            .catch(err => {
                next()
            })
    }
})

export default router
