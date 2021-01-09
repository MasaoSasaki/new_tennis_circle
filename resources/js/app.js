/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { forEach } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});

// 削除確認メッセージ
deleteConfirm = () => {
  if(window.confirm('本当に削除しますか？\nこのアルバムの保存済み写真データも同時に削除されます。')) {
    return true;
  } else {
    alert('キャンセルされました。');
    return false;
  }
};
deleteImageConfirm = () => {
  if(window.confirm('本当に削除しますか？')) {
    return true;
  } else {
    alert('キャンセルされました。');
    return false;
  }
};

// アップロード画像プレビュー
previewImages = (obj) => {
  const fileList = document.getElementById('file-list');
  const imagePreviewList = document.getElementById('image-preview-list');
  fileList.innerHTML = "";
  imagePreviewList.innerHTML = "";
  const files = obj.files;
  if (files.length === 0) { return }
  for (let i = 0; i < files.length; i++) {
    let fileReader = new FileReader();
    fileReader.readAsDataURL(files[i])
    imagePreviewList.insertAdjacentHTML('beforeend', `<li></li>`);
    fileList.insertAdjacentHTML('beforeend', `<li></li>`);
    fileReader.onload = () => {
      let dataUrl = fileReader.result;
      imagePreviewList.children[i].insertAdjacentHTML('afterbegin', `<img src="${ dataUrl }">`);
      fileList.children[i].insertAdjacentHTML('afterbegin', files[i].name);
    }
  };
  imagePreviewList.insertAdjacentHTML('beforeend', `<li><span>+${ files.length }</span></li>`);
}
