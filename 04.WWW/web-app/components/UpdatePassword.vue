<template>
  <div>
    <div>
      <v-img class="md:w-1/6 m-auto block" src="/img/logo-phuc-thinh-22.png"></v-img>
    </div>
    <h3 class="text-center text-xl font-semibold text-blue-600 tracking-tight">
      Thay đổi mật khẩu
    </h3>
    <div class="box-form m-auto">
      <validation-observer
        ref="observer"
        v-slot="{ invalid }"
      >
        <form @submit.prevent="submit">
          <validation-provider
            v-slot="{ errors }"
            name="Mật khẩu mới"
            rules="required"
          >
            <v-text-field
              v-model="new_password"
              :counter="10"
              :error-messages="errors"
              label="Mật khẩu mới"
              prepend-icon="mdi-lock"
              required
            ></v-text-field>
          </validation-provider>

          <validation-provider
            v-slot="{ errors }"
            name="Nhập lại mật khẩu"
            rules="required|confirmed:new_password"
          >
            <v-text-field
              v-model="confirm_password"
              :counter="10"
              :error-messages="errors"
              label="Nhập lại mật khẩu"
              required
              prepend-icon="mdi-lock"
            ></v-text-field>
          </validation-provider>
          <v-btn
            class="mr-4"
            type="submit"
            :disabled="invalid"
          >
            Cập nhật
          </v-btn>
          <v-btn @click="clear">
            Xóa
          </v-btn>
        </form>
      </validation-observer>
    </div>

  </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
import { required, confirmed } from 'vee-validate/dist/rules';
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate';
setInteractionMode('eager')
extend('required', {
  ...required,
  message: 'Vui lòng nhập {_field_}',
})
extend('confirmed', {
  ...confirmed,
  message: '{_field_} không trùng khớp',
})
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  name: "UpdatePassword",
  data() {
    return {
      new_password: '',
      confirm_password: '',
    }
  },
  computed: {
    ...mapGetters({
      user:'auth/user',
    }),
  },
  mounted() {
  },
  methods: {
    submit () {
      this.$refs.observer.validate()
    },
    clear () {
      this.name = ''
      this.phoneNumber = ''
      this.email = ''
      this.select = null
      this.checkbox = null
      this.$refs.observer.reset()
    },
  }
}
</script>
<style scoped lang="scss">
.box-form{
  padding: 30px;
  width: 70%;
  margin-top: 30px;
}
</style>
