export default {
  data() {
    return {
      items: [],
      loading: false,
      pagination: {
        page: 1,
        rowsPerPage: 15,
        totalItems: 0
      }
    };
  },
  computed: {
    pager() {
      return `${this.pagination.page || 1}${this.pagination.sortBy || "id"}${
        this.pagination.descending ? "desc" : "asc"
      }`;
    }
  },
  created() {
    if (!this.fetchItem) {
      throw new Error("API fetchItem method not implemented");
    }

    this.fetch();
  },
  methods: {
    fetch() {
      this.loading = true;

      this.fetchItem()
        .then(({ data }) => {
          [this.loading, this.items] = [false, data.data];

          if (data.meta) {
            this.$set(this, "pagination", {
              ...this.pagination,
              rowsPerPage: data.meta.per_page,
              totalItems: data.meta.total
            });
          }

          this.fetchFulfilled && this.fetchFulfilled(data);
        })
        .catch(({ response }) => {
          this.loading = false;

          this.items = [];

          this.fetchRejected && this.fetchRejected(response);
        });
    }
  },
  watch: {
    pager() {
      this.fetch();
    }
  }
};
