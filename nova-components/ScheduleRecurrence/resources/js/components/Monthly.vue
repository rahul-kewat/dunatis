<template>
  <div>
    
    <div class="grid grid-cols-2 grid-rows-2 margin-top">
      <label for="startTimePicker">
        Recur Every
      </label>

      <label for="startTimePicker">
        Choose start time
      </label>

      <input
        type="number"
        class="w-full form-control form-input form-input-bordered"
        min="1"
        max="31"
        v-model="options.recurEvery"
        style="width: 80px;"
      >

      <select
        name="startTimePicker"
        class="form-control form-select w-full"
        v-model="options.startTime"
        style="width: 120px;"
      >
        <option value="anytime">Anytime</option>
        <option v-for="time in timeOptions">{{ time }}</option>
      </select>
    </div>

    <div class="grid grid-cols-6 grid-rows-2 margin-top">
      <button
        v-for="month in months"
        type="button"
        class="btn btn-default"
        v-bind:class="{ 'day-selected': month.selected }"
        v-on:click="selectMonth(month)"
      >
        {{ month.name }}
      </button>
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
      checked: [],
      months: [
        {
          value: 1,
          selected: false,
          name: 'Jan'
        },
        {
          value: 2,
          selected: false,
          name: 'Feb'
        },
        {
          value: 3,
          selected: false,
          name: 'Mar'
        },
        {
          value: 4,
          selected: false,
          name: 'Apr'
        },
        {
          value: 5,
          selected: false,
          name: 'May'
        },
        {
          value: 6,
          selected: false,
          name: 'Jun'
        },
        {
          value: 7,
          selected: false,
          name: 'Jul'
        },
        {
          value: 8,
          selected: false,
          name: 'Aug'
        },
        {
          value: 9,
          selected: false,
          name: 'Sep'
        },
        {
          value: 10,
          selected: false,
          name: 'Oct'
        },
        {
          value: 11,
          selected: false,
          name: 'Nov'
        },
        {
          value: 12,
          selected: false,
          name: 'Dec'
        },
      ],
      options: {
        recurEvery: 1,
        startTime: "anytime",
      }
    }
  },

  mounted() {
      
  },

  computed: {
    
  },

  methods: {
    selectMonth(value) {
      value.selected = !value.selected
      // this.setSelectedWeekdays();
    },
  },
}
</script>

<style type="text/css" scoped>
  .margin-top {
    margin-top: 3%;
  }

  button {
    height: 60px;
    width: 64px;
    margin-top: 3%;
    background-color: #BCBCBC;
    color: white;
    font-size: 16px;
    padding: 0px;
  }
  .day-selected {
    background-color: #7d2bdc;
  }
</style>