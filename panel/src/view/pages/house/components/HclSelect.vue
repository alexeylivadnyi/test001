<template>
  <div class="component-wrapper">
    <div class="option-title">{{ title }}</div>
    <el-select
      v-bind="$attrs"
      v-on="$listeners"
      :placeholder="title"
      popper-class="w-full"
      @change="$emit('change', $event)"
      clearable
    >
      <el-option
        v-for="item in items"
        :key="item"
        :label="item"
        :value="item"
      />
    </el-select>
  </div>
</template>

<script>
  export default {
    name: "HclSelect",

    model: {
      prop: "value",
      event: "change"
    },

    props: {
      title: {
        type: String,
        default: ""
      },
      items: {
        type: Number,
        default: 0
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
  }
</style>
