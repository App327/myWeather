function addCity() {
 document.getElementById('win-add-city').style.display = 'block';
}

function addRecord() {
 document.getElementById('win-add-record').style.display = 'block';
}

function showSymbols() {
 document.getElementById('win-symbols').style.display = 'block';
}

function closeWindow(id) {
 document.getElementById(id).style.display = 'none';
}

var addRippleEffect = function (e) {
 var target = e.target;
 if (target.tagName.toLowerCase() !== 'button') return false;
 var rect = target.getBoundingClientRect();
 var ripple = target.querySelector('.gumines');
 if (!ripple) {
  ripple = document.createElement('span');
  ripple.className = 'gumines';
  ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
  target.appendChild(ripple);
 }
 ripple.classList.remove('show');
 var top = e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop;
 var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
 ripple.style.top = top + 'px';
 ripple.style.left = left + 'px';
 ripple.classList.add('show');
 return false; 
}
document.addEventListener('click', addRippleEffect, false);