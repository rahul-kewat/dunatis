<template>
  <div class="grid grid-rows-1 grid-flow-col gap-2">
    <div class="col-span-1">
      <div class="row-span col-span">
        <label for="startTimePicker" style="width: 120px;">
          Recur Every
        </label>
      </div>
      <div class="row-span col-span">
        <select name="startTimePicker" class="margin-top form-control form-select" style="">
          <option value="" selected="selected">Anytime</option>
          <option v-for="time in timeOptions">{{ time }}</option>
        </select>
      </div>    
    </div>
    <div class="col-span-1">
      <div class="row-span col-span">
        <label for="startTimePicker" style="width: 120px;">
          Choose start time
        </label>
      </div>
      <div class="row-span col-span">
        <select name="startTimePicker" class="margin-top form-control form-select" style="">
          <option value="" selected="selected">Anytime</option>
          <option v-for="time in timeOptions">{{ time }}</option>
        </select>
      </div>    
    </div>
  </div>
</template>

<script>

export default {
  props: {
    timeOptions: Array,
  },

  data() {
    return {
      
    }
  },

  mounted() {
      
  },

  computed: {
    
  },

  methods: {
    
  },
}
</script>

<style type="text/css" scoped>
  .margin-top {
    margin-top: 3%;
  }
</style>