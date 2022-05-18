<template>
  <div>
    <div class="row-span-2 col-span-2">
      <label for="startTimePicker">
        Choose start time
      </label>
    </div>

    <div class="row-span-2 col-span-2">
      <select
        name="startTimePicker"
        class="form-control form-select w-full"
        v-model="options.startTime"
        style="width: 120px; margin-top: 2%;"
      >
        <option value="anytime">Anytime</option>
        <option v-for="time in timeOptions">{{ time }}</option>
      </select>
    </div>

    <div class="margin-top row-span col-span">
      <div style="margin-top: 20px;">
        <input class="custom-radio" type="radio" id="recur-on-weekdays" value="weekdays" v-model="options.recurOn"/>
        <label for="recur-on-weekdays">Weekdays</label>

        <input class="custom-radio" type="radio" id="recur-on-weekends" value="weekends" v-model="options.recurOn"/>
        <label for="recur-on-weekends">Weekends</label>
      </div>
    </div>

    <div class="margin-top row-span col-span">
      <button
        v-for="(weekday, index) in weekdays"
        type="button"
        class="btn btn-default items-center"
        v-bind:class="{ 'day-selected': weekday.selected }"
        v-on:click="selectDay(weekday)"
      >
        {{ weekday.name }}
      </button>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    timeOptions: Array,
    values: Object
  },

  data() {
    return {
      weekdays: [
        {
          value: 1,
          selected: false,
          name: 'M'
        },
        {
          value: 2,
          selected: false,
          name: 'T'
        },
        {
          value: 3,
          selected: false,
          name: 'W'
        },
        {
          value: 4,
          selected: false,
          name: 'T'
        },
        {
          value: 5,
          selected: false,
          name: 'F'
        },
        {
          value: 6,
          selected: false,
          name: 'S'
        },
        {
          value: 0,
          selected: false,
          name: 'S'
        },
      ],
      options: {
        recurOn: Number,
        startTime: String,
        selected: Array
      }
    }
  },

  mounted() {
    this.options = this.values;

    for (let index in this.weekdays) {
      this.weekdays[index].selected = this.options.selected.includes(this.weekdays[index].value)
    }
  },

  computed: {
    
  },

  watch: {
    'options.recurOn': function (val) {
      this.selectPattern(val)
    },
    'options.startTime': function (val) {
      Nova.$emit('weeklySet', this.options)
    },
  },

  methods: {
    selectDay(value) {
      this.options.recurOn = 0
      value.selected = !value.selected
      this.setSelectedWeekdays();
    },
    selectPattern(val) {
      switch (val) {
        case 'weekdays':
          for (let index in this.weekdays) {
            this.weekdays[index].selected = index < 5
          }
        break;
        case 'weekends':
          for (let index in this.weekdays) {
            this.weekdays[index].selected = index >= 5
          }
        break;
      }
      this.setSelectedWeekdays();
    },
    setSelectedWeekdays() {
      let selected = []
      for (let index in this.weekdays) {
        if (this.weekdays[index].selected) {
          selected.push(this.weekdays[index].value)
        }
      }
      this.options.selected = selected
      Nova.$emit('weeklySet', this.options)
    }
  },
}
</script>

<style type="text/css" scoped>
  .day-selected {
    background-color: #7d2bdc;
  }
  button {
    height: 60px;
    width: 64px;
    margin-top: 3%;
    margin-right: 2%;
    background-color: #BCBCBC;
    color: white;
    font-size: 18px;
  }
</style>