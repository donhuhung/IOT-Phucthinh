<template>
  <div>
    <div class="flex items-center justify-between">
      <h3 class="title">Thông tin nhà máy</h3>
      <div class="relative text-gray-600">
        <input type="search" name="serch" placeholder="Search" class="bg-gray-100 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none">
        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
          <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
      <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
    </svg>
        </button>
      </div>
    </div>
    <div class="box-factory">
      <div class="flex flex-wrap">
        <div class="item 2xl:w-1/4 px-4">
            <div class="header">
              <p class="">HA THANH WATER SUPPLY FACTORY</p>
            </div>
            <div class="body">
              <p><span class="xl:font-bold">Address</span>:TX 43 Thạnh Xuân, Q12, Tp.HCM</p>
              <p><span class="xl:font-bold">IP</span>:192.168.0.13</p>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting
              </p>
              <img src="~/assets/img/factory.png" class="w-full">
            </div>
            <div class="footer">
                  <router-link to="/">
                      Truy cập
                  </router-link>
            </div>
        </div>
        <div class="item 2xl:w-1/4 px-4">
          <div class="header">
            <p class="">HA THANH WATER SUPPLY FACTORY</p>
          </div>
          <div class="body">
            <p><span class="xl:font-bold">Address</span>:TX 43 Thạnh Xuân, Q12, Tp.HCM</p>
            <p><span class="xl:font-bold">IP</span>:192.168.0.13</p>
            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              It has survived not only five centuries, but also the leap into electronic typesetting
            </p>
            <img src="~/assets/img/factory.png" class="w-full">
          </div>
          <div class="footer">
            <router-link to="/">
              Truy cập
            </router-link>
          </div>
        </div>
        <div class="item 2xl:w-1/4 px-4">
          <div class="header">
            <p class="">HA THANH WATER SUPPLY FACTORY</p>
          </div>
          <div class="body">
            <p><span class="xl:font-bold">Address</span>:TX 43 Thạnh Xuân, Q12, Tp.HCM</p>
            <p><span class="xl:font-bold">IP</span>:192.168.0.13</p>
            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              It has survived not only five centuries, but also the leap into electronic typesetting
            </p>
            <img src="~/assets/img/factory.png" class="w-full">
          </div>
          <div class="footer">
            <router-link to="/">
              Truy cập
            </router-link>
          </div>
        </div>
        <div class="item 2xl:w-1/4 px-4">
          <div class="header">
            <p class="">HA THANH WATER SUPPLY FACTORY</p>
          </div>
          <div class="body">
            <p><span class="xl:font-bold">Address</span>:TX 43 Thạnh Xuân, Q12, Tp.HCM</p>
            <p><span class="xl:font-bold">IP</span>:192.168.0.13</p>
            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              It has survived not only five centuries, but also the leap into electronic typesetting
            </p>
            <img src="~/assets/img/factory.png" class="w-full">
          </div>
          <div class="footer">
            <router-link to="/">
              Truy cập
            </router-link>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "factory",
  layout: "app"
}
</script>

<style scoped>
.box-factory{
  padding: 40px 0;
}
.header{
  background: #007BFF;
  padding: 20px;
  text-align: center;
  color:#fff;
  font-family: 'RobotoMedium',sans-serif;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.body{
  background: #FAFAFA;
  padding: 20px;
  color:#73879C;
}
.footer{
  background: #fff;
  padding: 10px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  box-shadow: 0px 18px 12px 0px rgb(217 218 227 / 80%);
}
.footer a{
  color:#fff;
  text-align: center;
  background: #1ABB9C;
  padding: 5px;
  border-radius: 45px;
  margin: auto;
  display: block;
  width: 60%;
}
</style>
