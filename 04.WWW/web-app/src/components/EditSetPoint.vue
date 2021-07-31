<template>
  <v-edit-dialog
    :return-value.sync="val"
    large
    :cancel-text="$t('layout.labelCancel')"
    :save-text="$t('layout.labelSave')"
    persistent
    @save="save"
    @cancel="cancel"
    @open="open"
    @close="close"
  >
    <v-btn :loading="submitting" text input-value="true" color="primary">
      {{ point | numberFormat }}
    </v-btn>
    <template v-slot:input>
      <div class="mt-4 text-h6">
        {{ $t('layout.labelUpdateSetPoint') }}
      </div>
      <v-text-field type="number"
        v-model="val"
        single-line
        autofocus
      ></v-text-field>
    </template>
  </v-edit-dialog>
</template>

<script>
import {updateSetPoint} from "@/api/app"
import {numberFormat} from "../filters/number";
export default {
  name: "EditSetPoint",
  props: {
    value: {},
    dataSensor:{}
  },
  filters: {
    numberFormat,
  },
  data() {
    return {
      snack: false,
      snackColor: false,
      snackText: false,
      val: '',
      point: undefined,
      submitting: false,
    }
  },
  mounted() {
    this.$watch('value', (value) => {
      this.val = value
      this.point = value
    }, { immediate: true})
  },
  methods: {
    async save () {
      try {
        const idSetPoint = this.dataSensor.id_set_point
        const fieldSetPoint = this.dataSensor.field_set_point
        const value = this.val
        this.submitting = true
        await updateSetPoint({idSetPoint, fieldSetPoint, value})
        const message = 'Cập nhật Set Point thành công!'
        this.$notify({message, title: '', type: 'success',})
        this.point = value
      } catch (e) {
        this.$notify({message: e.message, title: this.$t('layout.titleMess'), type: 'error'})
      } finally {
        this.submitting = false
      }
    },
    cancel () {
    },
    open () {
    },
    close () {
    },
  },
}
</script>

<style scoped>

</style>
