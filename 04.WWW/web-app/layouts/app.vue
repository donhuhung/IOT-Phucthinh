<template>
  <div class="h-screen w-full flex overflow-hidden select-none">
    <nav class="w-24 flex flex-col items-center bg-white dark:bg-gray-800 py-4">
      <!-- Left side NavBar -->
      <div>
        <!-- App Logo -->
        <svg
          class="h-8 w-8 fill-current text-blue-600 dark:text-blue-300"
          viewBox="0 0 24 24">
          <path
            d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3m6.82
					6L12 12.72 5.18 9 12 5.28 18.82 9M17 16l-5 2.72L7 16v-3.73L12
					15l5-2.73V16z"></path>
        </svg>

      </div>
      <ul class="mt-2 text-gray-700 dark:text-gray-400 capitalize">
        <!-- Links -->
        <template v-for="(nav, index) in navs">
          <li :key="index" class="mt-3 p-2 text-blue-600 dark:text-blue-300 rounded-lg">
            <a href="teacher-dashboard/" class=" flex flex-col items-center">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span class="text-xs mt-2">{{ $t(nav.label) }}</span>
            </a>
          </li>
        </template>
        <li class="mt-3 p-2 text-blue-600 dark:text-blue-300 rounded-lg">
          <a href="teacher-dashboard/" class=" flex flex-col items-center">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span class="text-xs mt-2">dashBoard</span>
          </a>
        </li>
        <li
          class="mt-3 p-2 hover:text-blue-600 dark-hover:text-blue-300
				rounded-lg">
          <a href="inbox/" class=" flex flex-col items-center">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span class="text-xs mt-2">messages</span>
          </a>

        </li>

        <li
          class="mt-3 p-2 hover:text-blue-600 dark-hover:text-blue-300
				rounded-lg">
          <a
            href="expenses-dashboard/"
            class=" flex flex-col items-center">
            <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
              <path
                d="M21 18v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0
							012-2h14a2 2 0 012 2v1h-9a2 2 0 00-2 2v8a2 2 0 002
							2m0-2h10V8H12m4 5.5a1.5 1.5 0 01-1.5-1.5 1.5 1.5 0
							011.5-1.5 1.5 1.5 0 011.5 1.5 1.5 1.5 0 01-1.5 1.5z"></path>
            </svg>
            <span class="text-xs mt-2">earnings</span>
          </a>

        </li>

        <li
          class="mt-3 p-2 hover:text-blue-600 dark-hover:text-blue-300
				rounded-lg">
          <a href="users-dashboard/" class=" flex flex-col items-center">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <span class="text-xs mt-2">jobs</span>
          </a>
        </li>
        <li
          class="mt-3 p-2 hover:text-blue-600 dark-hover:text-blue-300
				rounded-lg">
          <a href="meetup/" class=" flex flex-col items-center">
            <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
              <path
                d="M19 19H5V8h14m0-5h-1V1h-2v2H8V1H6v2H5a2 2 0 00-2
							2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2m-2.47
							8.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59
							17l5.94-5.94z"></path>
            </svg>
            <span class="text-xs mt-2">schedule</span>
          </a>

        </li>

        <li class="mt-3 p-2 hover:text-blue-600 rounded-lg">
          <a
            href="social-media-dashboard/"
            class=" flex flex-col items-center">
            <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
              <path
                d="M17 10.5V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0
							001 1h12a1 1 0 001-1v-3.5l4 4v-11l-4 4z"></path>
            </svg>
            <span class="text-xs mt-2">lesson</span>
          </a>

        </li>

      </ul>

      <div
        class="mt-auto flex items-center p-2 text-blue-700 bg-purple-200
			dark:text-blue-500 rounded-full">
        <!-- important action -->

        <a href="/">
          <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
            <path
              d="M12 1c-5 0-9 4-9 9v7a3 3 0 003 3h3v-8H5v-2a7 7 0 017-7
						7 7 0 017 7v2h-4v8h4v1h-7v2h6a3 3 0
						003-3V10c0-5-4.03-9-9-9z"></path>
          </svg>
        </a>

      </div>
    </nav>
    <main
      class="my-1 pt-2 pb-2 px-10 flex-1 bg-gray-200 dark:bg-black rounded-l-lg
		transition duration-500 ease-in-out overflow-y-auto">
      <Nuxt />
    </main>

    <aside
      class="w-1/4 my-1 mr-1 px-6 py-4 flex flex-col bg-gray-200 dark:bg-black
		dark:text-gray-400 rounded-r-lg overflow-y-auto">
      <!-- Right side NavBar -->

    </aside>

  </div>
</template>

<script>
export default {
  middleware({ store, redirect, route }) {
    if (!store.getters['auth/isLoggedIn']) {
      let query = { redirect: route.fullPath }
      redirect({ path: '/auth/login', query })
    }
  },
  data() {
    return {
      navs: [
        {
          label: 'layout.navFactory',
          icon: ''
        },
        {
          label: 'layout.navOverview',
          icon: ''
        },
        {
          label: 'layout.navSensor',
          icon: ''
        },
        {
          label: 'layout.navDevice',
          icon: ''
        },
        {
          label: 'layout.navChart',
          icon: ''
        },
        {
          label: 'layout.navMaps',
          icon: ''
        },
        {
          label: 'layout.navSetting',
          icon: ''
        },
      ]
    }
  }
}
</script>

<style scoped>

</style>
