import moment from 'moment'

Nova.booting((Vue, router, store) => {
  Vue.prototype.moment = moment;
  Vue.component('inspections', require('./components/Card'));
})
