const form     = document.querySelector('form');
const h_name   = document.querySelector('.h_name');
const comment  = document.querySelector('.comment');
const iframe   = document.querySelector('iframe');
const color    = document.querySelector('.color');
const lines    = document.querySelector('.lines');
const retime   = document.querySelector('.retime');
const nico     = document.querySelector(".nico");
const  roomUrl = document.querySelector('.roomUrl').value;

function color_select(colors) {
    Object.keys(colors).forEach((key, index) => {
        const option = document.createElement('option');
        if (index === 0)  option.selected = true;
        option.value = index;
        option.style.color = key;
        option.textContent = colors[key];
        color.appendChild(option);
    });
}

switch (roomUrl) {
  case '1971':
    color_select(olors_1970);
    break;
  case '00nuts':
    color_select(colors_jiko);
    break;
  case 'deai':
    color_select(colors_deai);
    break;
  case 'ai':
    color_select(colors_robo);
    break;
  case 'free-a':
  case 'free-b':
  case 'free-c':
    color_select(colors_free);
    break;
  case 'otona01':
  case 'otona02':
  case 'otona03':
    color_select(colors_otona);
  default: 
    color_select(colors);
    break;
}

function post() {
    fetch('./api.php',{
        method: 'post',
        body: new URLSearchParams({
            'roomUrl' : roomUrl,
            'color'   : color.value,
            'retime'  : retime.value,
            'lines'   : lines.value,
            'h_name'  : h_name.value.trim(),
            'comment' : comment.value.trim()
        })
    })
    .then(response => response.json())
    .then(json => {
        iframe.src = json;
    });
}

// 発言数、文字数、時間管理の処理
const oldTime = new Date().getTime();
let row = 0;  // 行数(発言数)
let sum = 0;  // 合計文字数
let len = ''; // 文字数
const conversion = (str) => {
    const newTime = new Date().getTime();
    totalSec = Math.floor((newTime - oldTime) / 1000);
    minu = Math.floor(totalSec / 60);
    sec = totalSec % 60;
    len = str.length;
    sum += len;
    row++;
    res = `😊｡oO( ${[ ...str].join(' ')} )_文字数(${len})_合計文字数(${sum})_発言数(${row})_${minu}分${sec}秒経過`;
    return res;
}

form.addEventListener('submit',e => {
    e.preventDefault();
    if(nico.checked) {
      if(!comment.value) return; // 顔文字連打防止
      comment.value = conversion(comment.value);
    } 
    post();
    comment.value = "";
});

// ページを更新してもname,select,checkboxの値が消えないようにlocalStorageに保存
 // localStorage に保存するキー名
const key = 'chat_username';
const key_retime = 'retime';
const key_lines  = 'lines';
const key_color  = 'color';
const key_check  = 'check';

const savedName = localStorage.getItem('chat_username');
const savedRetime = localStorage.getItem('retime');
const savedLines  = localStorage.getItem('lines');
const savedColor  = localStorage.getItem('color');
const savedCheck  = localStorage.getItem('check') === 'true';

if (savedName) h_name.value   = savedName;
if (savedRetime) retime.value = savedRetime;
if (savedLines) lines.value   = savedLines;
if (savedColor) color.value   = savedColor;
if (savedCheck) nico.checked  = savedCheck;

post(); //最初にPOSTで移動してきた時 or リロード時に実行する

// selectやcheckboxの値がchageするたびにlocalStorageに保存
retime.addEventListener('change',()=>{
  localStorage.setItem(key_retime, retime.value);
  post();
});
lines.addEventListener('change', ()=>{
  localStorage.setItem(key_lines, lines.value);
  post();
});
color.addEventListener('change', ()=>{
  localStorage.setItem(key_color, color.value);
});
nico.addEventListener('change', () => {
  localStorage.setItem(key_check, nico.checked);
});
// 入力するたびに localStorageに保存
h_name.addEventListener('input',()=>{
  localStorage.setItem(key, h_name.value);
});
