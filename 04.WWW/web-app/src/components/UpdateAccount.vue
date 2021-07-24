<template>
  <v-card width="100%"
          class="mx-auto"
          elevation="0"
          :disabled="submitting"
          :loading="submitting">
    <v-card-title class="text-h5">
      {{ $t('layout.labelUpdateInformation') }}
    </v-card-title>
    <v-card-text>
      Enter your email, phone, or username and we'll send you a link to get back into your account.
    </v-card-text>
    <v-card-text>
      <label>Avatar</label>
      <PictureUpload class="mx-auto" v-model="avatar"/>
      <validation-observer
          ref="observer"
          v-slot="{ invalid }"
      >
        <form @submit.prevent="submit">
          <div class="d-flex flex-wrap mx-n2">
            <div class="w-full px-2">
              <validation-provider
                  v-slot="{ errors }"
                  name="Họ & tên"
                  rules="required"
              >
                <v-text-field
                    v-model="name"
                    :error-messages="errors"
                    label="Họ & tên"
                    append-icon="mdi-account"
                    required
                ></v-text-field>
              </validation-provider>
            </div>
            <div class="w-full px-2">
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
                    append-icon="mdi-cellphone"
                    required
                ></v-text-field>
              </validation-provider>
            </div>
            <div class="w-full px-2">
              <validation-provider
                  v-slot="{ errors }"
                  name="email"
                  rules="required|email"
              >
                <v-text-field
                    v-model="email"
                    :error-messages="errors"
                    label="E-mail"
                    append-icon="mdi-email"
                    required
                ></v-text-field>
              </validation-provider>
            </div>
            <div class="w-full px-2">
              <validation-provider
                  v-slot="{ errors }"
                  name="Địa chỉ"
                  rules="required"
              >
                <v-text-field
                    v-model="address"
                    :error-messages="errors"
                    label="Địa chỉ"
                    append-icon="mdi-office-building-marker"
                    required
                ></v-text-field>
              </validation-provider>
            </div>
            <div class="w-full px-2">
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
                    append-icon="mdi-calendar-today"
                    required
                ></v-text-field>
              </validation-provider>
            </div>
            <div class="w-full px-2">
              <validation-provider
                  rules="required"
                  name="Giới tính"
              >
                <v-radio-group v-model="gender" label="Giới tính:" row
                               append-icon="fa-transgender">
                  <v-radio :ripple="false" value="Nam" name="gender" label="Nam"/>
                  <v-radio :ripple="false" value="Nữ" name="gender" label="Nữ"/>
                </v-radio-group>
              </validation-provider>
            </div>
          </div>
          <div class="flex space-x-2">
            <div class="d-flex">
              <v-btn @click="clear" width="150">
                {{ $t('layout.btnReset') }}
              </v-btn>
              <div class="mx-1"></div>
              <v-btn color="primary"
                     width="150"
                     type="submit"
                     :loading="submitting"
                     :disabled="invalid || submitting">
                {{ $t('layout.btnUpdate') }}
              </v-btn>
            </div>
          </div>
        </form>
      </validation-observer>
    </v-card-text>
  </v-card>
</template>
<script>
import {mapGetters} from 'vuex';
import {updateAccount, uploadAvatarAccount} from "../api/auth";
import {required, email} from 'vee-validate/dist/rules';
import {extend, ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate';
import PictureUpload from "./PictureUpload";

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
    PictureUpload,
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
      avatar: '',

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
      this.avatar = this.user.avatar;
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
        let avatar = this.avatar;

        this.submitting = true
        try {
          const res = await updateAccount({name, gender, email, phone, birthday, address});
          this.$store.commit("auth/updateUser", res.data.data);
          const text = 'Cập nhật thông tin thành công!'
          this.$notify({message: text, title: this.$t('layout.titleMess'), type: 'success',})
          if(avatar) {
            await uploadAvatarAccount({ avatar })
            this.$notify({message: text, title: this.$t('layout.titleMess'), type: 'success',})
          }
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
