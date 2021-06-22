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
                <p class="capitalize text-xl font-semibold text-blue-600 font-bold-italic">Nguyễn Văn Tèo</p>
                <p class="font-thin italic text-right">
                  <i class="fas fa-user-clock"></i>
                  Lần truy cập gần nhất: 15:30 18/06/2021
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
                <i class="far fa-id-card pr-3"></i>
                Thông tin chung
              </h4>
              <table>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Họ & tên:</td>
                  <td class="pl-2 font-light">Nguyễn Văn Tèo</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Email:</td>
                  <td class="pl-2 font-light">nguyenvanteo@gmail.com</td>
                </tr>
                <tr class="col-end-2 lg:h-10">
                  <td class="text-green-pt font-bold-italic">Giới tính:</td>
                  <td class="pl-2 font-light">Nam</td>
                  <td class="text-green-pt font-bold-italic">Ngày sinh:</td>
                  <td class="pl-2 font-light">05-01-1997</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Số điện thoại:</td>
                  <td class="pl-2 font-light">0916214477</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Địa chỉ:</td>
                  <td class="pl-2 font-light">Số 01 Thạnh Xuân, Quận 12</td>
                </tr>
              </table>
              <router-link to="/update-info" class="update-info">
                <i class="far fa-user-circle"></i>
                Cập nhật thông tin cá nhân
              </router-link>
            </div>
            <div class="box-info">
              <h4 class="inline-block text-xl font-semibold text-blue-600 tracking-tight capitalize pb-4">
                <i class="fas fa-sign-in-alt "></i>
                Thông tin đăng nhập
              </h4>
              <table>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">IP Đăng Nhập:</td>
                  <td class="pl-2 font-light">192.168.1.1</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Nhà máy:</td>
                  <td class="pl-2 font-light">Hà Thanh</td>
                </tr>
                <tr class="lg:h-10">
                  <td class="text-green-pt font-bold-italic">Mật khẩu:</td>
                  <td class="pl-2 font-light">
                    <input type="password" value="matkhaudangnhap"/>
                  </td>
                </tr>
              </table>
              <router-link to="/update-info" class="update-info">
                <i class="fas fa-sign-in-alt"></i>
                Cập nhật thông tin đăng nhập
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
                <router-link to="/change-password" class="btn-change-password">
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

export default {
  name: "AccountInformation",
  data() {
    return {
      userInfo:[]
    }
  },
  mounted() {
    this.getUserInfo();
  },
  methods: {
    getUserInfo(){// eslint-disable-line
      let avatar = require('../assets/img/factory.png');
      let obj = { avatar: avatar }
      this.userInfo = obj;
    },
  }
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
  width: 35%;
  margin-top: 20px;
  text-align: center;
}
table tr{
  font-size: 18px;
}
</style>
