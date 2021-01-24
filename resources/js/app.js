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

deleteConfirm = () => {
  if(window.confirm('本当に削除しますか？')) {
    return true;
  } else {
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
  document.getElementsByClassName('custom-file-label')[0].innerText = `${files.length} selected`
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
  const groupedField = document.getElementsByClassName('grouped')[0];
  if (status.checked) {
    isPublishedLabel.innerText =  "公開";
    groupedField.classList.remove('hide');
  } else {
    isPublishedLabel.innerText =  "非公開";
    groupedField.classList.add('hide');
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

postIsPublishedData = (radioForm) => {
  const userId = radioForm.name.replace('isPublished', '').replace('user_', '');
  const request = new XMLHttpRequest();
  const publishedData = radioForm.id == `publicUser_${userId}` ? true : false ;
  const csrfToken = radioForm.parentNode.parentNode.childNodes[0].value;
  if (publishedData) {
    request.open('POST', `/admin/public_user/${userId}`, true);
  } else {
    request.open('POST', `/admin/private_user/${userId}`, true);
  }
  request.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
  request.setRequestHeader('X-CSRF-Token', csrfToken);
  request.send();
  request.onreadystatechange = () => {
    // while文推奨
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('リクエストが完了しました。');
      }
    } else {
      console.log('通信中')
    }
  }
}