const checkboxes = document.querySelectorAll('input[type=checkbox]');

// When the user clicks on the checkbox the form will automagically submit.
checkboxes.forEach((checkbox) => {
  checkbox.onclick = function () {
    this.parentNode.submit();
  };
});

const changeAvatar = (document.getElementById('avatar').onchange = function () {
  this.form.submit();
});

const removeAvatar = (document.getElementById('remove-avatar').onchange =
  function () {
    this.form.submit();
  });
