Nova.booting((Vue, router, store) => {
  Vue.component('index-schedule-recurrence', require('./components/IndexField'))
  Vue.component('detail-schedule-recurrence', require('./components/DetailField'))
  Vue.component('form-schedule-recurrence', require('./components/FormField'))
  Vue.component('form-schedule-daily', require('./components/Daily'))
  Vue.component('form-schedule-weekly', require('./components/Weekly'))
  Vue.component('form-schedule-monthly', require('./components/Monthly'))
  Vue.component('form-schedule-annually', require('./components/Annually'))
})
