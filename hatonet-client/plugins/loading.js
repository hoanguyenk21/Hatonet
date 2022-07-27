import Vue from "vue";

Vue.component("LoadingBar", {
  template: `
<div class="progress m-2">
<div
  class="progress-bar progress-bar-indeterminate bg-warning"
></div>
</div>`,
});
