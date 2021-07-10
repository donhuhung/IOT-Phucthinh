import Vue from 'vue'
import Dialog from "./Dialog.vue";
export default function ({$axios, route, store, redirect, error, app }, inject) {

}
const Notify = {}
Notify.install = function(Vue) {
  const notify = ({title, message}) => {
    return new Promise((resolve, reject) => {
      const dialog = new Vue({
        methods: {
          closeHandler(fn, arg) {
            return function() {
              fn(arg);
              dialog.$destroy();
              dialog.$el.remove();
            };
          }
        },
        render(h) {
          return h(Dialog, {
            props: {
              title,
              message,
            },
            on: {
              confirm: this.closeHandler(resolve),
              cancel: this.closeHandler(reject, new Error('canceled'))
            }
          });
        }
      }).$mount();
      const appElm = document.getElementById('app')
      // document.body.appendChild(dialog.$el);
      appElm.appendChild(dialog.$el);
    });
  }
  Vue.prototype.$notify = notify
}
Vue.use(Notify, {})


