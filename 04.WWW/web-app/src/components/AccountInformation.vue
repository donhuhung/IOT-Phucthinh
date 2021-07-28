<template>
  <div class="w-full space-y-2">
    <v-card class="mx-auto" flat>
      <v-list-item two-line>
        <v-list-item-avatar size="100">
          <v-img :src="userInfo.avatar"/>
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="text-h5">
            {{ userInfo.name }}
          </v-list-item-title>
          <v-list-item-subtitle>Lần truy cập gần nhất: {{ userInfo.last_login }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider/>
      <v-card-title>
        Thông tin đăng nhập
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col>IP Đăng Nhập:</v-col>
          <v-col>{{ userInfo.factory ? userInfo.factory.ip : '' }}</v-col>
        </v-row>
        <v-row>
          <v-col>Nhà máy:</v-col>
          <v-col>{{ userInfo.factory ? userInfo.factory.name : '' }}</v-col>
        </v-row>
        <v-row>
          <v-col>Mật khẩu:</v-col>
          <v-col>
            <v-text-field type="password" value="matkhaudangnhap" disabled/>
          </v-col>
        </v-row>
      </v-card-text>
      <v-divider/>
      <v-card-title>
        Thông tin chung
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col>Họ & tên:</v-col>
          <v-col>{{ userInfo.name }}</v-col>
        </v-row>
        <v-row>
          <v-col>Email:</v-col>
          <v-col>{{ userInfo.email }}</v-col>
        </v-row>
        <v-row>
          <v-col>Giới tính:</v-col>
          <v-col>{{ userInfo.gender == 1 ? 'Nam' : 'Nữ' }}</v-col>
        </v-row>
        <v-row>
          <v-col>Ngày sinh:</v-col>
          <v-col>{{ userInfo.birthday }}</v-col>
        </v-row>
        <v-row>
          <v-col>Số điện thoại:</v-col>
          <v-col>{{ userInfo.phone }}</v-col>
        </v-row>
        <v-row>
          <v-col>Địa chỉ:</v-col>
          <v-col>{{ userInfo.address }}</v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-btn color="primary" :to="`/account-info`" class="update-info">
              Cập nhật thông tin cá nhân
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
      <v-divider/>
      <v-card-title>Bảo mật</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>Mật khẩu:</v-col>
          <v-col>
            <v-text-field readonly value="matkhaudangnhap" type="password" disabled/>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-btn color="primary" :to="`/account-password`" class="btn-change-password">
              Thay đổi mật khẩu
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
  name: "AccountInformation",
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      factory: 'auth/factory'
    }),
    userInfo() {
      return this.user || {}
    },
    rootFactory() {
      const { params: {customer, factory} } = this.$route
      return `/customers/${customer}/factory/${factory}`
    }
  },
}
</script>
<style scoped>

</style>
