<template>
  <div style="height: 160px; width: 160px; position: relative;"
       class="overflow-hidden">
    <div ref="uploader"></div>
  </div>
</template>

<script>
import {create, registerPlugin} from "filepond"
import "filepond/dist/filepond.min.css"

import FilePondPluginFileEncode from "filepond-plugin-file-encode"
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type"
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation"
import FilePondPluginImageCrop from "filepond-plugin-image-crop"
import FilePondPluginImageResize from "filepond-plugin-image-resize"
import FilePondPluginImageTransform from "filepond-plugin-image-transform"
import FilePondPluginImagePreview from "filepond-plugin-image-preview"

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"


export default {
  name: "PictureUpload",
  props: {
    value: {}
  },
  data() {
    return {
      pond: undefined,
    }
  },
  mounted() {
    registerPlugin(FilePondPluginFileEncode)
    registerPlugin(FilePondPluginFileValidateType)
    registerPlugin(FilePondPluginImageExifOrientation)
    registerPlugin(FilePondPluginImageCrop)
    registerPlugin(FilePondPluginImageResize)
    registerPlugin(FilePondPluginImageTransform)
    registerPlugin(FilePondPluginImagePreview)
    const input = this.$refs.uploader
    const _self = this
    this.pond = create(input, {
      disabled: false,
      labelIdle: `<p class="caption ma-0">Drag & Drop your picture or <span class="filepond--label-action">Browse</span></p>`,
      allowMultiple: false,
      allowImageResize: true,
      allowReorder: true,
      acceptedFileTypes: "image/jpeg, image/png",
      imagePreviewHeight: "100",
      imageCropAspectRatio: "1:1",
      imageResizeTargetWidth: "200",
      imageResizeTargetHeight: "200",
      stylePanelLayout: "compact circle",
      styleLoadIndicatorPosition: "center bottom",
      styleButtonRemoveItemPosition: "center bottom",
      onaddfile: _self.onAddFile,
      oninit: _self.onInit,
      onerror: this.onError
    })
    this.$watch('value', async (v) => {
      // await pond.removeFiles()
      if(v) {
        // await pond.addFile(v)
      }
    }, {immediate: true})
  },
  computed: {},

  methods: {
    onAddFile(_,res) {
      console.error('onAddFile', res)
      this.$emit('input', res.file)
    },
    onInit(...res) {
      console.error('init', res)
      const { value } = this
      if(value) {
        this.pond.addFile(value)
        // this.pond.addFile('https://znews-photo.zadn.vn/w1920/Uploaded/ngogtn/2021_03_13/Billy_Crudup_Maribel_Verdu.jpeg')
        // this.pond.addFile('https://www.htechsolution.vn/phucthinh/admin/storage/app/uploads/public/60f/c09/023/60fc09023b389929686837.png')
      }
    },
    onError(...res) {
      console.error('onError', res)
    }
  },
}
</script>

<style lang="scss">
.filepond--credits {
  display: none;
}

.caption_label {
  &.has_uploaded {
    .img_uploaded {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      z-index: -1;
      width: 100%;
      height: 100%;
    }

    .caption_uploaded {
      background: #f1f0ef;
      position: absolute;
      width: 100%;
      height: 60%;
      z-index: 1;
      bottom: -110%;
      left: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      padding: 0px 10px;
    }

    &:hover {
      .caption_uploaded {
        transition: all 0.25s linear;
        bottom: 0%;
      }
    }
  }
}


.my-pond {
  .filepond--panel-root {

  }
}

</style>
