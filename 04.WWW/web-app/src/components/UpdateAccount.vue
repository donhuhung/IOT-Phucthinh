<template>
  <div>
    <v-card width="450px" class="m-auto" :disabled="submitting" :loading="submitting">
      <v-card-title class="text-center">Cập nhật thông tin cá nhân</v-card-title>
      <v-card-text>
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
                  :error-messages="errors"
                  label="Họ & tên"
                  prepend-icon="mdi-account"
                  required
              ></v-text-field>
            </validation-provider>

            <validation-provider
                v-slot="{ errors }"
                name="Số điện thoại"
                rules="required"
            >
              <v-text-field
                  v-model="phoneNumber"
                  :counter="12"
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
                name="Ngày sinh"
                rules="required"
            >
              <v-text-field
                  v-model="birthday"
                  :error-messages="errors"
                  label="Ngày sinh"
                  type="date"
                  prepend-icon="mdi-calendar-today"
                  required
              ></v-text-field>
            </validation-provider>

            <validation-provider
                rules="required"
                name="Giới tính"
            >
              <v-radio-group v-model="gender" label="Giới tính"
                             prepend-icon="fa-transgender">
                <v-radio :ripple="false" value="Nam" name="gender" label="Nam"/>
                <v-radio :ripple="false" value="Nữ" name="gender" label="Nữ"/>
              </v-radio-group>
            </validation-provider>
            <div class="flex space-x-2">
              <v-spacer/>
              <v-btn @click="clear" width="120">
                Xóa
              </v-btn>
              <v-btn color="primary"
                     width="120"
                     type="submit"
                     :disabled="invalid">
                Cập nhật
              </v-btn>
              <v-spacer/>
            </div>
          </form>
        </validation-observer>
      </v-card-text>
    </v-card>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
import {updateAccount} from "../api/auth";
import {required, email} from 'vee-validate/dist/rules';
import {extend, ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate';

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
      gender: '',
      address: '',
      birthday: '',
      submitting: false,

    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  mounted() {
    this.getInfoUser();
  },
  methods: {
    getInfoUser() {
      this.name = this.user.name;
      this.email = this.user.email;
      this.phoneNumber = this.user.phone;
      this.address = this.user.address;
      this.birthday = this.user.birthday;
      this.gender = this.user.gender;
    },
    async submit(e) {
      e.preventDefault()
      const isValid = this.$refs.observer.validate();
      if (isValid) {
        let name = this.name;
        let email = this.email;
        let phone = this.phoneNumber;
        let address = this.address;
        let birthday = this.birthday;
        let gender = this.gender;

        this.submitting = true
        try {
          const res = await updateAccount({name, gender, email, phone, birthday, address});
          this.$store.commit("auth/updateUser", res.data);
          const text = 'Cập nhật thông tin thành công!'
          this.$notify({message: text, title: this.$t('layout.titleMess'), type: 'notify_success',})
        } catch (e) {
          this.$notify({message: e.message, title: this.$t('layout.titleMess'), type: 'error'})
        }
        this.submitting = false
      }
    },
    redirectSetting() {
      const route = {
        name: 'factory-factory-setting',
        params: {
          factory: this.$route.params.factory
        }
      }
      this.$router.replace(route)
    },
    clear() {
      this.name = ''
      this.phoneNumber = ''
      this.email = ''
      this.gender = null
      this.address = ''
      this.birthday = ''
      this.$refs.observer.reset()
    },
  }
}
</script>
<style scoped lang="scss">
</style>
