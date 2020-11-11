<template>
  <div class="component-wrapper">
    <div class="option-title">{{ title }}</div>
    <div class="slider-holder">
      <el-slider
        v-bind="$attrs"
        v-model="items"
        :min="min"
        :max="max"
        v-on="$listeners"
        range
        style="width: 90%; text-align: center;"
        @input="input"
      />
    </div>
    <div class="text-holder">
      <el-input-number
        v-model="curMinPrice"
        :min="min"
        :max="max"
        size="mini"
      />
      <el-input-number
        v-model="curMaxPrice"
        :min="min"
        :max="max"
        size="mini"
      />
    </div>
  </div>
</template>

<script>
  export default {
    name: "HclSlider",

    model: {
      prop: "value",
      event: "change"
    },

    props: {
      title: {
        type: String,
        default: ""
      },
      min: Number,
      max: Number
    },

    data() {
      return {
        curMinPrice: this.min,
        curMaxPrice: this.max,
        items: [this.min, this.max]
      };
    },

    mounted() {
      this.curMinPrice = this.min;
      this.curMaxPrice = this.max;
    },

    computed: {
      // emptyValue() {
      //   return this.value[0] === null && this.value[0] === this.value[1];
      // },
      // itms() {
      //   if (this.emptyValue) {
      //     return [this.min, this.max];
      //   }
      //   return this.value;
      // }
    },

    methods: {
      input(val) {
        this.curMinPrice = val[0];
        this.curMaxPrice = val[1];
      }
    },

    watch: {
      min(val) {
        this.curMinPrice = val;
      },
      max(val) {
        this.curMaxPrice = val;
      },
      curMinPrice(val) {
        this.items[0] = val;
        this.$emit("change", [val, this.curMaxPrice]);
      },
      curMaxPrice(val) {
        this.items[1] = val;
        this.$emit("change", [this.curMinPrice, val]);
      },
      value() {
        // debugger;
        // if (this.emptyValue) {
        //   this.items = [this.curMinPrice, this.curMaxPrice];
        // }
      }
    }
  };
</script>

<style scoped lang="scss">
  .component-wrapper {
    margin: 20px 0;

    & > * {
      width: 100%;
    }

    .option-title {
      margin-bottom: 5px;
    }

    .slider-holder,
    .text-holder {
      display: flex;
      justify-content: center;
    }

    .slider-holder {
      justify-content: center;
    }

    .text-holder {
      justify-content: space-around;
    }
  }
</style>
