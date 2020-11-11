<template>
  <el-container>
    <el-header class="header">
      {{ title }}
    </el-header>
    <el-container>
      <el-aside class="aside-form">
        <aside-form :filter-info="filterInfo" :external-loading="loading" />
      </el-aside>
      <el-main>
        <router-view />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
  import AsideForm from "./AsideForm";
  import fetchMixin from "../../../mixins/fetchMixin";
  import { filterInfo } from "../../../api/house";

  export default {
    name: "Index",

    components: { AsideForm },

    mixins: [fetchMixin],

    data() {
      return {
        filterInfo: {},
        filters: {}
      };
    },

    provide() {
      const params = {};

      Object.defineProperty(params, "filters", {
        enumerable: true,
        get: () => this.filters,
        set: val => this.$set(this, "filters", { ...val })
      });

      return { params };
    },

    computed: {
      title() {
        return this.$route.meta.title || "Page title";
      }
    },

    methods: {
      fetchItem() {
        return filterInfo();
      },
      fetchFulfilled({ data }) {
        this.filterInfo = { ...data.data, prices: [0, data.data.max_price] };
      },
      fetchRejected() {
        this.$notify.error({
          title: "Error",
          message:
            "Error with data fetching. Try again later or contact with developers"
        });
      }
    }
  };
</script>

<style scoped>
  .aside-form {
    border-right: 1px solid #ccc;
  }
  .header {
    background-color: #409eff;
    color: #fff;
    line-height: 60px;
    font-size: 1.5rem;
  }
</style>
