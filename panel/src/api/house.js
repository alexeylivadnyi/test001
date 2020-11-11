import Vue from "vue";

export const housesIndex = params => Vue.http.get("houses", { params });

export const filterInfo = () => Vue.http.get("info");
