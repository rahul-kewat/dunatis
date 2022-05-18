<template>
  <div>
    <div class="row-span col-span">
      <label for="startTimePicker">
        Choose start time
      </label>
    </div>
    <div class="row-span col-span">
      <select name="startTimePicker" class="margin-top form-control form-select w-full" style="width: 120px;">
        <option value="" selected="selected">Anytime</option>
        <option v-for="time in timeOptions">{{ time }}</option>
      </select>
      
      <div class="margin-top row-span col-span">
        <input class="custom-radio" type="radio" id="repeatOption-1" :value="1" v-model="repeatOption" />
        <label class="" for="repeatOption-1">Repeat by interval</label>
      </div>

      <div class="margin-top row-span col-span">
        <label class="" for="repeat-interval">Choose repeat interval</label>
      </div>
      <div class="row-span col-span">
        <select 
          id="repeat-interval" 
          class="margin-top form-control form-select w-full" 
          v-molel="repatInterval" 
          style="width: 266px;"
          :disabled="!repeatOption"
        >
          <option value="" selected="selected">Repeat Interval</option>
          <option v-for="time in everyOptions">Every {{ time }} hours</option>
        </select>
      </div>

      <div class="margin-top row-span col-span">
        <input class="custom-radio" type="radio" id="repeatOption-0" :value="0" v-model="repeatOption" />
        <label class="" for="repeatOption-0">Set number of repeats by time</label>
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
      repeatOption: 0,
      repatInterval: null,
      everyOptions: [3, 4, 6, 12]
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
  .row-span-3 {
    border-right: 1px solid #ddd;
  }
  .margin-top {
    margin-top: 3%;
  }
</style>