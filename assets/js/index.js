const checkboxes = document.querySelectorAll('input[type=checkbox]');

// When the user clicks on the checkbox the form will automagically submit.
checkboxes.forEach((checkbox) => {
  checkbox.onclick = function () {
    this.parentNode.submit();
  };
});

//Change and remove profile avatar

// const changeAvatar = (document.getElementById('avatar').onchange = function () {
//   this.form.submit();
// });

// const removeAvatar = (document.getElementById('remove-avatar').onchange =
//   function () {
//     this.form.submit();
//   });

// Generate random colors on task divs

// You could easily add more colors to this array.
var colors = [
  'red',
  'blue',
  'green',
  'teal',
  'rosybrown',
  'tan',
  'plum',
  'saddlebrown',
];
var boxes = document.querySelectorAll('.task-items');

for (i = 0; i < boxes.length; i++) {
  // Pick a random color from the array 'colors'.
  boxes[i].style.backgroundColor =
    colors[Math.floor(Math.random() * colors.length)];
  boxes[i].style.width = '100px';
  boxes[i].style.height = '100px';
  boxes[i].style.display = 'inline-block';
}
