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
  document.getElementsByClassName('custom-file-label')[0].innerText = `${files.length} selected`
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

// Checkbox toggle action
togglePublished = (status) => {
  const isPublishedLabel = document.getElementById('isPublished--label');
  const isGroupedInput = document.getElementById('isGroupedSwitch');
  const isGroupedLabel = document.getElementById('isGrouped--label');
  const isPublishedWarn = document.getElementsByClassName('warning-message')[0];
  if (status.checked) {
    isPublishedLabel.innerText =  "公開";
    isGroupedInput.removeAttribute('disabled');
    isPublishedWarn.remove();
  } else {
    isPublishedLabel.innerText =  "非公開";
    isGroupedInput.setAttribute('disabled', 'disabled');
    isGroupedLabel.insertAdjacentHTML('beforeend', '<span class="warning-message">（現在"非公開"になっています。）<span>');
  }
}
toggleGrouped = (status) => {
  const isGroupedLabel = document.getElementById('isGrouped--label');
  const createMemberField = document.getElementsByClassName('create-member-field')[0];
  if (status.checked) {
    isGroupedLabel.innerText = "グループ公開";
    createMemberField.classList.remove('hide');
  } else {
    isGroupedLabel.innerText = "全体公開";
    createMemberField.classList.add('hide');
  }
}

// モーダルウィンドウ
showModal = (img) => {
  const modalWindow = document.getElementsByClassName('modal-window')[0];
  modalWindow.classList.add('show');
  const modalImage = document.getElementsByClassName('modal-image')[0];
  const imageUrl = img.getAttribute('src');
  modalImage.setAttribute('src', imageUrl)
}
hideModal = () => {
  const modalWindow = document.getElementsByClassName('modal-window')[0];
  modalWindow.classList.remove('show');
  const modalImage = document.getElementsByClassName('modal-image')[0];
  modalImage.setAttribute('src', '')
}

// アルバムにユーザー名を関連づける
addNames = (obj) => {
  if(obj) { return }
  const userNames = JSON.parse(document.getElementById('js-getNames').dataset.names);
  const inputField = document.getElementById('name');
  const errorMessage = document.getElementsByClassName('error-message')[0];
  errorMessage.innerText = "";
  if (!userNames.includes(inputField.value)) {
    if (inputField.value == "") { return }
    errorMessage.innerText = "名前が見つかりませんでした。";
    return;
  } else {
    const nameList = document.getElementsByClassName('name');
    if (nameList.length >= 1) {
      for(i = 0; i < nameList.length; i++) {
        if(`${inputField.value} X` == nameList[i].textContent) {
          errorMessage.innerText = "すでに選択されています。";
          return
        }
      };
    }
    document.getElementsByClassName('create-member-field')[0].insertAdjacentHTML(
      'beforeend',
      `<span class="name">${inputField.value} <span class="delete-name" onClick="removeName(this);">X</span><input type="hidden" name="names[]" value="${inputField.value}"></span>`
    )
    inputField.value = "";
  }
}

removeName = (obj) => {
  obj.parentElement.remove();
}