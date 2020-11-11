<template>
  <div>
    <el-table
      :data="items"
      v-loading="loading"
      border
      class="data-container"
      @sort-change="sortChange"
    >
      <el-table-column prop="name" label="Name" width="300" sortable />
      <el-table-column
        prop="price"
        label="Price"
        width="180"
        align="center"
        sortable
      />
      <el-table-column
        prop="bedrooms"
        label="Bedrooms"
        align="center"
        sortable
      />
      <el-table-column
        prop="bathrooms"
        label="Bathrooms"
        align="center"
        sortable
      />
      <el-table-column prop="storeys" label="Storeys" align="center" sortable />
      <el-table-column prop="garages" label="Garages" align="center" sortable />
    </el-table>
    <div class="pagination-container">
      <el-pagination
        layout="prev, pager, next"
        :total="pagination.totalItems"
        :page-size="pagination.rowsPerPage"
        :current-page.sync="pagination.page"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import { housesIndex } from "../../../api/house";
  import datatablesFetchMixin from "../../../mixins/datatablesFetchMixin";
  import debounce from "debounce";

  export default {
    name: "List",

    mixins: [datatablesFetchMixin],

    inject: ["params"],

    data() {
      return {
        sortProp: "",
        sortOrder: ""
      };
    },

    methods: {
      fetchItem() {
        const params = {
          page: this.pagination.page,
          ...this.params.filters
        };
        if (this.sortProp) {
          params.sort_by = this.sortProp;
          params.sort_order = this.sortOrder;
        }
        return housesIndex(params);
      },
      fetchRejected() {
        this.$notify.error({
          title: "Error",
          message:
            "Error with data fetching. Try again later or contact with developers"
        });
      },
      // eslint-disable-next-line
      sortChange: debounce(function({ _, prop, order }) {
        if (order === null) {
          this.sortProp = "";
          this.sortOrder = "";
        } else {
          this.sortProp = prop;
          this.sortOrder = order;
        }
        this.fetch();
      }, 1000)
    },

    watch: {
      "params.filters"() {
        this.fetch();
      }
    }
  };
</script>

<style scoped lang="scss">
  .data-container {
    margin-bottom: 20px;
    width: 100% !important;
  }

  .pagination-container {
    display: flex;
    justify-content: center;
  }
</style>
