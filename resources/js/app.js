require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// --------------------chat messages----------------------------
const { default: axios } = require('axios');

const messages = document.getElementById('messages');
// const username = document.getElementById('username');
const message_input = document.getElementById('message_input');
const message_form = document.getElementById('message_form');

message_form.addEventListener('submit',function(e){
    e.preventDefault();
    const options = {
        method: 'post',
        url: '/messages',
        data : {
           // username : username.value,
            message : message_input.value,
        }
    }
    axios(options);
});

window.Echo.channel('private-chat')
.listen('.MessageSent',(e)=>{
    console.log(e.message);
    // messages.innerHTML(e.message );
    messages.innerHTML += '<div class="message">'+e.message+'</div>'

});