function addCity() {
 showWinBkg(closeWindow);
 document.getElementById('win-add-city').style.display = 'block';
 document.getElementById('win-add-city').classList.add('show');
}

function addRecord() {
 showWinBkg(closeWindow);
 document.getElementById('win-add-record').style.display = 'block';
 document.getElementById('win-add-record').classList.add('show');
}

function showAbout() {
 showWinBkg(closeWindow);
 document.getElementById('win-about').style.display = 'block';
 document.getElementById('win-about').classList.add('show');
}

function showVersion() {
 showWinBkg(closeWindow);
 document.getElementById('win-version').style.display = 'block';
 document.getElementById('win-version').classList.add('show');
}

function showSymbols() {
 showWinBkg(closeWindow);
 document.getElementById('win-symbols').style.display = 'block';
 document.getElementById('win-symbols').classList.add('show');
}

function closeWindow(event, id) {
 closeWinBkg();
 let wins = document.getElementsByClassName('window');
 for (let i = 0; i < wins.length; i++) {
  wins[i].classList.remove('show');
  setTimeout(() => wins[i].style.display = 'none', 300);
 }
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
 setTimeout(() => document.onclick = checkMoreOptClose, event, 400);
}

function closeMoreOpt() {
 moreopt.classList.remove('show');
 setTimeout(() => moreopt.style.display = 'none', 310);
 moreopt_btn.onclick = showMoreOpt;
}

function checkMoreOptClose(event) {
 if (event.target.className.includes('moreopt') || event.target.className.includes('moreopt-btn')) {
 } else {
  closeMoreOpt();
  document.onclick = null;
 }
}

function showWinBkg() {
 let bkg = document.getElementsByClassName('win-bkg')[0];
 bkg.style.display = 'block';
 bkg.onclick = closeWindow;
}

function closeWinBkg() {
 let bkg = document.getElementsByClassName('win-bkg')[0];
 bkg.style.display = 'none';
 bkg.onclick = null;
}