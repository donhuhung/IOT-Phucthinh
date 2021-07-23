<template>
  <div>
    <div>
      <div class="mt-8 md:w-8/12 m-auto p-2">
        <form accept-charset="UTF-8" v-on:submit.prevent="onSubmit()" method="POST">
            <div class="flex items-center justify-center">
              <div class="pr-12">
                <img class="avatar" :src="this.userInfo.avatar" alt="">
              </div>
              <div>
                <p class="capitalize text-xl font-semibold text-blue-600 font-bold-italic">{{userInfo.name}}</p>
                <p class="font-thin italic text-right">
                  <i class="fas fa-user-clock"></i>
                  Lần truy cập gần nhất: {{userInfo.last_login}}
                </p>
                <a href="javascript:void(0)" class="upload-avatar">
                  <i class="fas fa-camera"></i>
                  Cập nhật ảnh đại diện
                </a>
              </div>
            </div>
          <div>
            <div class="box-info mt-4">
              <h4 class="inline-block text-xl font-semibold text-blue-600 tracking-tight capitalize pb-4">
                <i class="fas fa-sign-in-alt "></i>
                Thông tin đăng nhập
              </h4>
              <table>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">IP Đăng Nhập:</td>
                  <td class="pl-2 font-light">{{userInfo.factory?userInfo.factory.ip:''}}</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Nhà máy:</td>
                  <td class="pl-2 font-light">{{userInfo.factory?userInfo.factory.name:''}}</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Mật khẩu:</td>
                  <td class="pl-2 font-light">
                    <input type="password" value="matkhaudangnhap"/>
                  </td>
                </tr>
              </table>
            </div>
            <div class="box-info">
              <h4 class="inline-block text-xl font-semibold text-blue-600 tracking-tight capitalize pb-4">
                <i class="far fa-id-card pr-3"></i>
                Thông tin chung
              </h4>
              <table>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Họ & tên:</td>
                  <td class="pl-2 font-light">{{userInfo.name}}</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Email:</td>
                  <td class="pl-2 font-light">{{userInfo.email}}</td>
                </tr>
                <tr class="col-end-2 lg:h-10">
                  <td class="text-green-pt font-bold-italic">Giới tính:</td>
                  <td class="pl-2 font-light">{{userInfo.gender==1?'Nam':'Nữ'}}</td>
                  <td class="text-green-pt font-bold-italic">Ngày sinh:</td>
                  <td class="pl-2 font-light">{{userInfo.birthday}}</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Số điện thoại:</td>
                  <td class="pl-2 font-light">{{userInfo.phone}}</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Địa chỉ:</td>
                  <td class="pl-2 font-light">{{userInfo.address}}</td>
                </tr>
              </table>
              <router-link :to="`${rootFactory}/account-info`" class="update-info">
                <i class="far fa-user-circle"></i>
                Cập nhật thông tin cá nhân
              </router-link>
            </div>
            <div class="box-info">
              <h4 class="inline-block text-xl font-semibold text-blue-600 tracking-tight capitalize pb-4">
                <i class="fas fa-key"></i>
                Bảo mật
              </h4>
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <table>
                    <tr>
                      <td class="text-green-pt font-bold-italic">Mật khẩu:</td>
                      <td class="pl-2 font-light">
                        <input type="password" value="matkhaudangnhap"/>
                      </td>
                    </tr>
                  </table>
                </div>
                <router-link :to="`${rootFactory}/account-password`" class="btn-change-password">
                  <i class="fas fa-unlock-alt"></i>
                  Thay đổi mật khẩu
                </router-link>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
  name: "AccountInformation",
  data() {
    return {
      userInfo:[]
    }
  },
  computed: {
    ...mapGetters({
      user:'auth/user',
    }),
    rootFactory() {

      return `/customers/${this.$route.params.customer}`
    }
  },
}
</script>
<style scoped>
.avatar{
  border-radius: 50%;
  width: 150px;
  height: 150px;
  object-fit: cover;
}
.upload-avatar{
  color: #fff;
  background-color: #007BFF;
  padding: 5px 20px;
  border-radius: 10px;
  display: block;
  margin-top: 10px;
  text-align: center;
  width: 75%;
}
.box-info{
  background: #ffffff;
  border-radius: 10px;
  margin-bottom: 20px;
  padding: 20px;
}
.btn-change-password{
  color:#ffffff;
  background-color: #007BFF;
  padding: 5px 20px;
  border-radius: 10px;
}
.update-info{
  color: #ffffff;
  background-color: #007BFF;
  padding: 7px 20px;
  border-radius: 10px;
  margin: auto;
  display: block;
  width: 40%;
  margin-top: 20px;
  text-align: center;
}
table tr{
  font-size: 18px;
}
</style>
