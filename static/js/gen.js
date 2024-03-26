function addCity() {
 document.getElementById('win-add-city').style.display = 'block';
}

function addRecord() {
 document.getElementById('win-add-record').style.display = 'block';
}

function showAbout() {
 document.getElementById('win-about').style.display = 'block';
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

window.onmouseover = function(event) {
 let text = event.target.dataset.tooltip;
 let tooltip = document.getElementsByClassName('tooltip')[0];
 if (text !== undefined) {
  tooltip.innerHTML = text;
  let x = event.clientX;
  let y = event.clientY;
  tooltip.style.top = y + 'px';
  tooltip.style.left = x + 'px';
  tooltip.style.display = 'block';
 } else {
  tooltip.style.display = 'none';
 }
 window.onmousemove = function(event) {
  let x = event.clientX;
  let y = event.clientY;
  tooltip.style.top = y + 'px';
  tooltip.style.left = x + 'px';
 }
}

let moreopt = document.getElementsByClassName('moreopt')[0];
let moreopt_btn = document.getElementById('moreopt-btn');

function showMoreOpt() {
 moreopt.style.display = 'block';
 moreopt.classList.add('show');
 moreopt_btn.onclick = closeMoreOpt;
}

function closeMoreOpt() {
 moreopt.classList.remove('show');
 setTimeout(() => moreopt.style.display = 'none', 500);
 moreopt_btn.onclick = showMoreOpt;
}
