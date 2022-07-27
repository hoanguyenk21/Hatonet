<template>
  <vue-editor :editor-toolbar="customToolbar" @input="changeinput"></vue-editor>
</template>

<script>
export default {
  name: "TextEditor",
  props:['text'],
  data: () => ({
    content: "",
    customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
  }),

  methods:{
    changeinput(e){
      this.$emit('input',e)
    }
  }
}
</script>
