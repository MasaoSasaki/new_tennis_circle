validates = (form) => {
  const value = form.value;
  removeClass(form);
  switch (form.name) {
    case 'last_name':
      if (value === '') { openError('文字が入力されていません。', form); return }
      addValidClass(form);
      break
    case 'first_name':
      if (value === '') { openError('文字が入力されていません。', form); return }
      addValidClass(form);
      break
    case 'email':
      if (value === '') { openError('文字が入力されていません。', form); return }
      if (!value.match(/@/)) { openError('"@(アットマーク)"を含めてください。', form); return }
      if (!value.match(/\./)) { openError('".(ドット)"を含めてください。', form); return }
      addValidClass(form);
      break
    case 'password':
      if (value === '') { openError('文字が入力されていません。', form); return }
      if (value.length < 8) { openError('8文字以上入力してください。', form); return }
      const passwordConfirm = document.getElementById('password-confirm').value;
      if (passwordConfirm !== "" && value !== passwordConfirm) { openError('パスワードが一致しません。', form); return }
      addValidClass(form);
      break
    case 'password_confirmation':
      if (value === '') { openError('文字が入力されていません。', form); return }
      if (value.length < 8) { openError('8文字以上入力してください。', form); return }
      const password = document.getElementById('password').value;
      if (value !== password) { openError('パスワードが一致しません。', form); return }
      addValidClass(form);
      break
  }
}
addInvalidClass = (form) => {
  form.classList.add('is-invalid');
}
addValidClass = (form) => {
  form.nextElementSibling.innerHTML = `<span class="success-message">OK</span>`;
  form.classList.add('is-valid');
}
removeClass = (form) => {
  if (form.classList.contains('is-valid')) {
    form.classList.remove('is-valid')
  } else if (form.classList.contains('is-invalid')) {
    form.classList.remove('is-invalid')
  }
}
openError = (error, form) => {
  form.nextElementSibling.innerHTML = `<span class="error-message">${ error }</span>`;
  addInvalidClass(form);
}
