<template>
  <div class="component-wrapper">
    <div class="option-title">{{ title }}</div>
    <el-input
      v-bind="$attrs"
      v-on="$listeners"
      placeholder="name"
      clearable
      @input="$emit('change', $event)"
    />
  </div>
</template>

<script>
  export default {
    name: "HclText",

    model: {
      prop: "value",
      event: "input"
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
