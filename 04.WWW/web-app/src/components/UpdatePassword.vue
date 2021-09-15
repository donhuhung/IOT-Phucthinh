<template>
  <v-card width="450px"
          class="mx-auto"
          elevation="0"
          :disabled="submitting"
          :loading="submitting">
    <v-card-title class="text-h5">
      {{ $t('layout.labelUpdatePassword') }}
    </v-card-title>
    <v-card-text>
      Enter your email, phone, or username and we'll send you a link to get back into your account.
    </v-card-text>
    <v-card-text>
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
            ></v-text-field>
          </validation-provider>
          <v-row>
            <v-col>
              <v-btn @click="clear" width="100%">
                {{ $t('layout.btnReset') }}
              </v-btn>
            </v-col>
            <v-col>
              <v-btn width="100%"
                     class="mr-4"
                     type="submit"
                     color="primary"
                     :disabled="invalid"
              >
                {{ $t('layout.btnUpdate') }}
              </v-btn>
            </v-col>
          </v-row>
        </form>
      </validation-observer>
    </v-card-text>
  </v-card>
</template>
<script>
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
      submitting: false,
    }
  },
  methods: {
    async submit() {
      const isValid = this.$refs.observer.validate();
      if (isValid) {
        let new_password = this.new_password;
        let confirm_password = this.confirm_password;
        try {
          this.submitting = true
          await changePassword({new_password, confirm_password});
          const message = 'Cập nhật mật khẩu thành công!';
          this.$notify({message, type: 'success'})
          this.clear()
        } catch (e) {
          this.$notify({message: e.message, type: 'error'})
        } finally {
          this.submitting = false
        }
      }
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
