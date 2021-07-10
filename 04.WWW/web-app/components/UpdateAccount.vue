<template>
  <div>
    <div>
      <v-img class="md:w-1/6 m-auto block" src="/img/logo-phuc-thinh-22.png"></v-img>
    </div>
    <h3 class="text-center text-xl font-semibold text-blue-600 tracking-tight">
      Cập nhật thông tin cá nhân
    </h3>
    <div class="box-form m-auto">
      <validation-observer
        ref="observer"
        v-slot="{ invalid }"
      >
        <form @submit.prevent="submit">
          <validation-provider
            v-slot="{ errors }"
            name="Họ & tên"
            rules="required"
          >
            <v-text-field
              v-model="name"
              :counter="10"
              :error-messages="errors"
              label="Họ & tên"
              prepend-icon="mdi-account"
              required
            ></v-text-field>
          </validation-provider>

          <validation-provider
            v-slot="{ errors }"
            name="phoneNumber"
            :rules="{
          required: true,
          digits: 12,
        }"
          >
            <v-text-field
              v-model="phoneNumber"
              :counter="7"
              :error-messages="errors"
              label="Số Điện thoại"
              prepend-icon="mdi-cellphone"
              required
            ></v-text-field>
          </validation-provider>
          <validation-provider
            v-slot="{ errors }"
            name="email"
            rules="required|email"
          >
            <v-text-field
              v-model="email"
              :error-messages="errors"
              label="E-mail"
              prepend-icon="mdi-email"
              required
            ></v-text-field>
          </validation-provider>

          <validation-provider
            v-slot="{ errors }"
            name="Địa chỉ"
            rules="required"
          >
            <v-text-field
              v-model="address"
              :error-messages="errors"
              label="Địa chỉ"
              prepend-icon="mdi-office-building-marker"
              required
            ></v-text-field>
          </validation-provider>

          <validation-provider
            v-slot="{ errors }"
            rules="required"
            name="Giới tính"
          >
            <v-checkbox
              v-model="gender"
              :error-messages="errors"
              value="Nam"
              label="Nam"
              type="checkbox"
              required
            ></v-checkbox>
            <v-checkbox
              v-model="gender"
              :error-messages="errors"
              value="Nữ"
              label="Nữ"
              type="checkbox"
              required
            ></v-checkbox>
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
import { required, email } from 'vee-validate/dist/rules';
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate';
setInteractionMode('eager')
extend('required', {
  ...required,
  message: 'Vui lòng nhập {_field_}',
})
extend('email', {
  ...email,
  message: 'Email không đúng định dạng',
})
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  name: "UpdateAccount",
  data() {
    return {
      name: '',
      phoneNumber: '',
      email: '',
      gender:'',
      address:''
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
