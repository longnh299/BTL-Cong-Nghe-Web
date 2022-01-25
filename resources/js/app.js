require('./bootstrap');

let color_square = document.getElementsByClassName('color-square');

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

for (let i = 0; i < color_square.length; i++) {
  color_square[i].style.fill = getRandomColor();

}
