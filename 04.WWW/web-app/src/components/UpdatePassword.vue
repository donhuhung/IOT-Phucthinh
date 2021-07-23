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
              rules="required|min:8"
          >
            <v-text-field
                v-model="new_password"
                :error-messages="errors"
                label="Mật khẩu mới"
                prepend-icon="mdi-lock"
                required
            ></v-text-field>
          </validation-provider>

          <validation-provider
              v-slot="{ errors }"
              name="Nhập lại mật khẩu"
              rules="required|min:8"
          >
            <v-text-field
                v-model="confirm_password"
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
import {mapGetters} from 'vuex';
import {required, min} from 'vee-validate/dist/rules';
import {extend, ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate';
import {changePassword} from "../api/auth";

setInteractionMode('eager')
extend('required', {
  ...required,
  message: 'Vui lòng nhập {_field_}',
})
extend('min', {
  ...min,
  message: '{_field_} tối thiểu từ {length} kí tự trợ lên',
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
      user: 'auth/user',
      statusAPI: 'auth/status_api',
      messageError: 'auth/messageError'
    }),
  },
  mounted() {
  },
  methods: {
    async submit() {
      const isValid = this.$refs.observer.validate();
      if (isValid) {
        let new_password = this.new_password;
        let confirm_password = this.confirm_password;
        try {
          await changePassword({new_password, confirm_password});
          const message = 'Cập nhật mật khẩu thành công!';
          this.showDialog(message)
        }catch (e) {
          this.showDialog('Error')
        }
      }
    },
    showDialog(message) {
      this.$notify({message})
    },
    clear() {
      this.new_password = ''
      this.confirm_password = ''
      this.$refs.observer.reset()
    },
  }
}
</script>
<style scoped lang="scss">
.box-form {
  padding: 30px;
  width: 70%;
  margin-top: 30px;
}
</style>
