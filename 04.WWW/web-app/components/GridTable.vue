<template>
  <table class="w-full">
    <tr>
      <template v-for="(header, index) in headers">
        <th class="border p-2" :key="index">{{ header.text }}</th>
      </template>
    </tr>
    <template v-for="(row, rowIndex) in items">
      <tr :key="rowIndex">
        <template v-for="(header, cellIndex) in headers">
          <td :key="`${rowIndex}-${cellIndex}`" class="border p-2">
            {{ row[header.name] }}
          </td>
        </template>
      </tr>
    </template>
  </table>
</template>

<script>
export default {
  name: "GridTable",
  props: {
    headers: {
      type: Array,
      default: () => [
        {
          name: 'user_name',
          text: 'User Name (TEXT)'
        },
        {
          name: 'email',
          text: 'Email User (TEXT)'
        },
      ],
    },
    items: {
      type: Array,
      default: () => [
        {
          email: 'dnh@gmail_1.com',
          user_name: 'Hung Dep Trai 1',
        },
        {
          email: 'dnh@gmail_2.com',
          user_name: 'Hung Dep Trai 2',
        },

      ],
    },
  }
}
</script>

<style scoped>

</style>
