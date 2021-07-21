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
import {updateSetPoint} from "@/api/app"
export default {
  name: "EditSetPoint",
  props: {
    value: {},
    dataSensor:{}
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
    async save () {
      this.snack = true
      this.snackColor = 'success'
      this.snackText = 'Data saved'
      try {
        const idSetPoint = this.dataSensor.id_set_point
        const fieldSetPoint = this.dataSensor.field_set_point
        const value = this.val
        const res = await updateSetPoint({idSetPoint, fieldSetPoint, value})
        const text = 'Cập nhật Set Point thành công!'
        this.$notify({text, title: '', type: 'notify_success',})
      } catch (e) {
        this.$notify({text: e.message, title: this.$t('layout.titleMess'), type: 'error'})
      } finally {}
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
