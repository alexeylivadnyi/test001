import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

export const routes = [
  {
    path: "/",
    name: "house",
    meta: {
      title: "Главная"
    },
    component: () =>
      import(
        /* webpackChunkName: "mainPage" */ `./../view/pages/house/Index.vue`
      ),
    children: [
      {
        path: "",
        name: "houseList",
        meta: {
          title: "Real estate"
        },
        component: () =>
          import(
            /* webpackChunkName: "mainPage" */ "./../view/pages/house/List"
          )
      }
    ]
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
