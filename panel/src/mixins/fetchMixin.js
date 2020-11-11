export default {
  data() {
    return {
      data: null,
      loading: false,
      submitLoading: false
    };
  },
  created() {
    if (this.fetchItem) {
      this.fetch();
    }
  },
  methods: {
    fetch() {
      this.loading = true;

      this.fetchItem()
        .then(response => {
          this.loading = false;
          this.data = Array.isArray(response)
            ? response[0].data
            : response.data;

          this.fetchFulfilled && this.fetchFulfilled(response);
        })
        .catch(response => {
          this.loading = false;

          this.fetchRejected && this.fetchRejected(response);
        });
    }
  }
};
