<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
        <div class="grid grid-rows grid-flow-col gap-10">
          <div class="delimiter">
            <div v-for="(name, key) in field.recurrences" style="margin-bottom: 20px;">
              <input class="custom-radio" type="radio" :id="key + '-' + _uid" :value="key" v-model="options.recurrence" />
              <label class="" :for="key + '-' + _uid">{{ name }}</label>
            </div>
          </div>
          <div class="col-span-2">
            <div v-if="options.recurrence == 'daily'">
              <form-schedule-daily :timeOptions="timeDropdownOptions"></form-schedule-daily>
            </div>
            <div v-else-if="options.recurrence == 'weekly'">
              <form-schedule-weekly :timeOptions="timeDropdownOptions" :values="options.weekly"></form-schedule-weekly>
            </div>
            <div v-else-if="options.recurrence == 'monthly'">
              <form-schedule-monthly :timeOptions="timeDropdownOptions"></form-schedule-monthly>
            </div>
            <div v-else-if="options.recurrence == 'annually'">
              <form-schedule-annually :timeOptions="timeDropdownOptions"></form-schedule-annually>
            </div>

            <div class="grid grid-rows-1 grid-flow-col gap-2" style="margin-top: 3%">
              <div class="col-span-1">
                <input
                  type="number"
                  class="w-full form-control form-input form-input-bordered"
                  min="1"
                  max="3"
                  v-model="repeatsByTimeCount"
                  style="width: 100px;"
                >
              </div>
              <div class="col-span-1" v-for="i in 3">
                <select
                  v-show="i - 1 < repeatsByTimeCount"
                  :name="'startTimePicker-' + i"
                  class="margin-top form-control form-select w-full"
                  style="width: 120px;"
                  v-model="options.repeatsByTimeValues[i-1]"
                >
                  <option value="anytime" selected :disabled="repeatsByTimeCount > 1">Anytime</option>
                  <option
                    v-for="time in timeDropdownOptions"
                    :value="time"
                  >
                    {{ time }}
                  </option>
                </select>
              </div>
            </div>
          </div>
        </div> 
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      repeatsByTimeCount: 1,
      options: {
        recurrence: '',
        repeatsByTimeValues: ['anytime', 'anytime', 'anytime'],
        weekly: {
          recurOn: 0,
          startTime: "anytime",
          selected: []
        }
      },
    }
  },

  created() {
    Nova.$on('weeklySet', this.setWeeklyValue)
  },

  mounted() {

  },

  watch: {
    'options.recurrence': function (val) {
      this.setJsonValue()
    },
    'repeatsByTimeCount': function (val) {
      this.setJsonValue()
    },
    'options.repeatsByTimeValues': function (val) {
      this.setJsonValue()
    }
  },

  computed: {
    timeDropdownOptions : function () {
      let items = [];

      for (let i = 0; i < 2; ++i) {
        for (let h = 1; h <= 12; ++h) {
          items.push((h < 10 ? '0' : '') + h + ':00' + (i ? 'PM' : 'AM'))
        }
      }
      return items; 
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      // this.value = this.field.value || ''
      let data = JSON.parse(this.field.value);
      this.options.recurrence = data.recurrence || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },

    setJsonValue() {
      this.value = JSON.stringify(this.options)
      console.log(this.value)
    },

    setWeeklyValue(val) {
      this.options.weekly = val
      this.setJsonValue()
    }
  },
}
</script>

<style type="text/css">
  [type="radio"]:checked,
  [type="radio"]:not(:checked) {
      position: absolute;
      left: -9999px;
  }
  [type="radio"]:checked + label,
  [type="radio"]:not(:checked) + label
  {
      position: relative;
      padding-left: 35px;
      cursor: pointer;
      line-height: 20px;
      display: inline-block;
      color: #666;
  }
  [type="radio"]:checked + label:before,
  [type="radio"]:not(:checked) + label:before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 20px;
      height: 20px;
      border: 1px solid #ddd;
      border-radius: 100%;
      background: #fff;
  }
  [type="radio"]:checked + label:after,
  [type="radio"]:not(:checked) + label:after {
      content: '';
      width: 14px;
      height: 14px;
      background: #7D2BDC;
      position: absolute;
      top: 3px;
      left: 3px;
      border-radius: 100%;
      -webkit-transition: all 0.2s ease;
      transition: all 0.2s ease;
  }
  [type="radio"]:not(:checked) + label:after {
      opacity: 0;
      -webkit-transform: scale(0);
      transform: scale(0);
  }
  [type="radio"]:checked + label:after {
      opacity: 1;
      -webkit-transform: scale(1);
      transform: scale(1);
  }
</style>

<style type="text/css" scoped>
  .grid-rows-3 {
    grid-template-rows: unset;
  }
  .delimiter {
    border-right: 1px solid #ddd;
    /*width: 300px;*/
  }
</style>