var loginbtn = document.getElementById('loginbtn');
var userBox = document.getElementById('form');
var closebtn = document.getElementById('close');
loginbtn.addEventListener ('click', showUserBox);
function showUserBox(){
  userBox.style.display = "block"
}
closebtn.addEventListener('click', closeUserBox);
function closeUserBox(){
  userBox.style.display = "none"
}