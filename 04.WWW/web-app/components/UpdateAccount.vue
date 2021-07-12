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
              checked="gender=='Nam'?'true':'false'"
            ></v-checkbox>
            <v-checkbox
              v-model="gender"
              :error-messages="errors"
              value="Nữ"
              label="Nữ"
              type="checkbox"
              checked="gender=='Nữ'?'true':'false'"
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
import {updateAccount} from "../api/auth";
import { required, email } from 'vee-validate/dist/rules';
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate';
import {getListFactory} from "../api/app";
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
      address:'',
      birthday:''
    }
  },
  computed: {
    ...mapGetters({
      user:'auth/user',
      statusAPI:'auth/status_api',
      messageError:'auth/messageError'
    }),
  },
  mounted() {
    this.getInfoUser();
  },
  methods: {
    getInfoUser(){
      this.name = this.user.name;
      this.email = this.user.email;
      this.phoneNumber = this.user.phone;
      this.address = this.user.address;
      this.birthday = this.user.birthday;
      this.gender = this.user.gender;
    },
    updateAccount,
    async submit (e) {
      const isValid = this.$refs.observer.validate();
      if (isValid) {
        let name = this.name;
        let email = this.email;
        let phone = this.phoneNumber;
        let address = this.address;
        let birthday = this.birthday;
        let gender = this.gender;
        const res = await this.updateAccount({name,gender,email,phone, birthday, address});
        if(this.statusAPI === 'error'){
          const message = this.messageError;
          this.showDialog(message)
        }
        else{
          const message = 'Cập nhật thông tin thành công!';
          this.showDialog(message)
          this.redirectSetting()
        }
      }
    },
    showDialog(message){
      this.$nuxt.$emit('success', message)
      this.$notify({message})
    },
    redirectSetting() {
      const path = '/factory/'+this.$route.params.factory+'/setting'
      setTimeout(() => this.$router.replace({path})
        , 2000);
    },
    clear () {
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
.box-form{
  padding: 30px;
  width: 70%;
  margin-top: 30px;
}
</style>
