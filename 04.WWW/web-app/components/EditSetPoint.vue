<template>
  <v-edit-dialog
    :return-value.sync="val"
    large
    persistent
    @save="save"
    @cancel="cancel"
    @open="open"
    @close="close"
  >
    <div>{{ val }}</div>
    <template v-slot:input>
      <div class="mt-4 text-h6">
        Update SetPoint
      </div>
      <v-text-field type="number"
        v-model="val"
        label="Edit"
        single-line
        counter
        autofocus
      ></v-text-field>
    </template>
  </v-edit-dialog>
</template>

<script>
export default {
  name: "EditSetPoint",
  props: {
    value: {}
  },
  data() {
    return {
      snack: false,
      snackColor: false,
      snackText: false,
      val: '',
    }
  },
  mounted() {
    this.$watch('value', (value) => {
      this.val = value
    }, { immediate: true})
  },
  methods: {
    save () {
      this.snack = true
      this.snackColor = 'success'
      this.snackText = 'Data saved'
    },
    cancel () {
      this.snack = true
      this.snackColor = 'error'
      this.snackText = 'Canceled'
    },
    open () {
      this.snack = true
      this.snackColor = 'info'
      this.snackText = 'Dialog opened'
    },
    close () {
      console.log('Dialog closed')
    },
  },
}
</script>

<style scoped>

</style>
