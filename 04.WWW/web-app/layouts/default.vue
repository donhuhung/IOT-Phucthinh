<template>
  <div>
    <Nuxt />
  </div>
</template>

<style>
@font-face {
  font-family: RobotoMedium;
  src: url(~/assets/fonts/Roboto-Medium.ttf);
}
@font-face {
  font-family: RobotoRegular;
  src: url(~/assets/fonts/Roboto-Regular.ttf);
}
@font-face {
  font-family: RobotoBold;
  src: url(~/assets/fonts/Roboto-Bold.ttf);
}
html {
  font-family: 'RobotoRegular',sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}
a:hover{
  color:#007BFF;
}
a{
  color:#007BFF;
}
input{
  border-radius: 45px !important;
  font-size: 16px;
  height: 60px;
  outline: none;
  color:#686868;
}
.title-welcome{
  font-family: 'RobotoMedium',sans-serif;
  font-size: 24px;
}
</style>
