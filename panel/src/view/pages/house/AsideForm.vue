<template>
  <div class="aside-form__container">
    <h1 class="text-center">Choose filters and search</h1>
    <el-form>
      <hcl-text title="Search by appartment's name" v-model="fields.name" />
      <hcl-select
        title="Select bedrooms quantity"
        :items="filterInfo.bedrooms"
        v-model="fields.bedrooms"
        :loading="externalLoading"
      />
      <hcl-select
        title="Select bathrooms quantity"
        :items="filterInfo.bathrooms"
        v-model="fields.bathrooms"
        :loading="externalLoading"
      />
      <hcl-select
        title="Select garages quantity"
        :items="filterInfo.garages"
        v-model="fields.garages"
        :loading="externalLoading"
      />
      <hcl-select
        title="Select storeys quantity"
        :items="filterInfo.storeys"
        v-model="fields.storeys"
        :loading="externalLoading"
      />
      <hcl-slider
        title="Set min and max price"
        v-model="fields.prices"
        :min="filterInfo.prices[0]"
        :max="filterInfo.prices[1]"
        v-if="filterInfo.prices && filterInfo.prices.length === 2"
      />
      <div class="item">
        <el-button type="primary" @click="submit">Search</el-button>
      </div>
      <div class="item">
        <el-button type="primary" @click="reset" plain>Reset</el-button>
      </div>
    </el-form>
  </div>
</template>

<script>
  import HclSelect from "./components/HclSelect";
  import HclText from "./components/HclText";
  import HclSlider from "./components/HclSlider";

  export default {
    name: "AsideForm",

    inject: ["params"],

    props: {
      filterInfo: {
        type: Object,
        default: () => ({})
      },
      externalLoading: {
        type: Boolean,
        default: false
      }
    },

    components: {
      HclSelect,
      HclText,
      HclSlider
    },

    data() {
      return {
        fields: this.getInitials()
      };
    },

    methods: {
      getInitials: () => ({
        name: "",
        bedrooms: null,
        bathrooms: null,
        storeys: null,
        garages: null,
        prices: [null, null]
      }),
      submit() {
        const filters = {};
        for (const [key, value] of Object.entries(this.fields)) {
          if (!value) {
            continue;
          }
          if (key === "prices" && value.length === 2) {
            filters.min_price = value[0];
            filters.max_price = value[1];
            continue;
          }
          filters[key] = value;
        }

        this.params.filters = { ...filters };
      },
      reset() {
        this.$set(this, "fields", this.getInitials());

        this.params.filters = {};
      }
    }
  };
</script>

<style scoped lang="scss">
  .aside-form__container {
    padding: 20px 10px 10px;
  }

  .item {
    &:not(:first-child) {
      margin: 10px 0;
    }
    & > * {
      width: 100%;
    }
  }

  .spinner-holder {
    display: flex;
    justify-content: center;
  }
</style>
<style>
  .text-center {
    text-align: center;
  }
</style>
