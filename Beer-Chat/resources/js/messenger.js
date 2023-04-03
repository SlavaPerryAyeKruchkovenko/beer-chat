const axios = require("axios");
const feather = require("feather-icons")
const MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}
const apiManager = {
    sendMessage: (text,chatId,userId) => {
        return axios.post("/message", {
            message: text,
            chat_id: chatId,
            user_id: userId,
        });
    },
    getUserByName: (name) => {
        return axios.get("/user/" + name);
    },
    getAllChats: (userId) => {
        return axios.get("/chats/ " + userId);
    },
    getAllMessages: (chatId) => {
        return axios.get("/messages/" + chatId);
    },
    getUserById: (userId) => {
        return axios.get("/user/" + userId);
    },
    deleteMessage: (messageId) => {
        return axios.delete(`/message/${messageId}`);
    },
    createChat: (firstUser,secondUser) => {
        return axios.post(`/chat`,{
            user_id:firstUser,
            second_user_id: secondUser
        });
    }
}
const messengerVM = {
    chatHeader: document.getElementById("chat-name"),
    currentUser: Number(document.querySelector('meta[name="user_id"]').content),
    messageBlock: document.getElementById("messages"),
    usersBlock: document.getElementById('users'),
    currentChat: null,
    userChats : [],
    sendMessage: (input) => {
        const text = input.value
        if(messengerVM.currentChat && messengerVM.currentChat.id != null){
            apiManager.sendMessage(text,messengerVM.currentChat.id,messengerVM.currentUser).catch(e => {
                console.log(e);
            });
            input.value = "";
        }
        return false;
    },
    appendMessage: (message, user) => {
        const messenger = messengerVM.messageBlock;
        if (message && user) {
            messenger.appendChild(messengerVM.getMessageView(
                message,
                user,
                message.user_id === messengerVM.currentUser));
            messenger.scrollTo(0, messenger.scrollHeight);
        }
    },
    getMessageView: (message,user,isLeft) => {
        const elem = document.createElement('li');
        elem.innerHTML = `<img class="low-user-image" src="${messengerVM.getUserAvatar(user)}" alt="profile">
            <div class="message">
                <span class="message-text">${message.text}</span>
            </div>`;
        elem.classList.add("message-block");
        elem.setAttribute("id", `message${message.id}`);
        if (isLeft) {
            elem.classList.add("left-message");
        } else {
            elem.classList.add("right-message");
        }
        const messageText = elem.querySelector('.message');
        messageText.addEventListener("contextmenu", (e) => {
            e.preventDefault();
            messageText.appendChild(messengerVM.createMessageMenu(message.id));
        })
        return elem;
    },
    createMessageMenu: (messageId) => {
        const menu = document.createElement('div');
        const deleteSvg = feather.icons['trash-2'].toSvg({class: 'icon', id: 'delete'});
        const closeSvg = feather.icons['x-circle'].toSvg({class: 'icon', id: 'close'});
        menu.classList.add('menu');
        menu.innerHTML = `${deleteSvg}${closeSvg}`;
        const closeBtn = menu.querySelector('#close');
        const deleteBtn = menu.querySelector('#delete');
        closeBtn.addEventListener('click', () => {
            menu.remove();
            closeBtn.classList.add('red-icon');
        });
        deleteBtn.addEventListener('click', () => {
            deleteBtn.classList.add('red-icon');
            apiManager.deleteMessage(messageId).catch(e => console.log(e));
            menu.remove();
        });
        const closeMenu = e => {
            if (!e.target.closest('.menu')) {
                menu.remove();
                document.removeEventListener("click",closeMenu,true);
            }
        }
        document.addEventListener('click', closeMenu,true);
        return menu;
    },
    deleteMessageView: (messageId) => {
        const message = messengerVM.messageBlock.querySelector(`#message${messageId}`);
        message.remove();
    },
    getUserAvatar: (user) => {
        return `https://www.gravatar.com/avatar/${MD5(user.email)}?d=https://ui-avatars.com/api/${user.username}/128/random`;
    },
    writeAllMessages: (messages) => {
        messages.forEach(message => {
            messengerVM.appendMessage(message, message.user);
        })
    },
    printAllMessages: (chatId) => {
        messengerVM.messageBlock.innerHTML = `<svg class="loader" width="200" height="200">
                <circle cx="100" cy="100" r="50" class="circle_loader" id="circle"></circle>
                <text x="100" y="100" id="pct" ></text>
            </svg>`;
        startAnimate()
        messengerVM.messageBlock.classList.add("center");
        apiManager.getAllMessages(chatId).then(data => {
            if (data.data) {
                stopAnimate()
                messengerVM.messageBlock.innerHTML = "";
                messengerVM.messageBlock.classList.remove("center");
                messengerVM.writeAllMessages(data.data)
            }
        }).catch(e => {
            stopAnimate()
            messengerVM.messageBlock.innerHTML = "";
            messengerVM.messageBlock.classList.remove("center");
            console.log(e);
        })
    },
    getProfileView:(user) => {
        const profile = document.createElement('div');
        profile.setAttribute("id", `user${user.id}`);
        profile.classList.add("profile");
        profile.innerHTML = `
            <img class="min-user-image" src="${messengerVM.getUserAvatar(user)}" alt="profile">
            <span class="profile-name">${user.name}</span>`;
        profile.addEventListener("click", () => {
            if(!(messengerVM.currentChat && (messengerVM.currentChat.second_user_id === user.id ||
                messengerVM.currentChat.first_user_id === user.id))){
                messengerVM.openChat(user);
            }
        })
        return profile;
    },
    openChat: (user) => {
        messengerVM.messageBlock.innerHTML = `<svg class="loader" width="200" height="200">
                <circle cx="100" cy="100" r="50" class="circle_loader" id="circle"></circle>
                <text x="100" y="100" id="pct" ></text>
            </svg>`;
        messengerVM.messageBlock.classList.add("center");
        startAnimate()
        apiManager.createChat(messengerVM.currentUser, user.id).then(data => {
            stopAnimate()
            messengerVM.messageBlock.innerHTML = "";
            messengerVM.messageBlock.classList.remove("center");
            messengerVM.currentChat = data.data;
            messengerVM.writeAllMessages(data.data.messages)
            messengerVM.chatHeader.textContent = user.name;

            console.log(`chat.${messengerVM.currentChat.id}`)
            Echo.private(`chat.${messengerVM.currentChat.id}`)
                .listen('MessageSend', (e) => {
                    console.log(e)
                    messengerVM.appendMessage(e.message, e.user);
                });
            Echo.private(`chat.${messengerVM.currentChat.id}`)
                .listen('MessageDelete', (e) => {
                    messengerVM.deleteMessageView(e.message.id);
                });
        }).catch(() => {
            stopAnimate()
            messengerVM.messageBlock.innerHTML = "";
            messengerVM.messageBlock.classList.remove("center");
        });
    },
    printProfiles: (users) => {
        users.forEach(user => {
            const haveUser = messengerVM.userChats.find(x => x.id === user.id);
            if (!haveUser && user.id !== messengerVM.currentUser) {
                messengerVM.userChats.push(user);
                const profileHtml = messengerVM.getProfileView(user);
                messengerVM.usersBlock.appendChild(profileHtml);
            }
        })
        messengerVM.userChats.forEach(user => {
            const haveUser = users.find(x=>x.id === user.id);
            if(!haveUser){
                const profile = document.getElementById(`user${user.id}`);
                if(profile){
                    profile.remove();
                }
            }
            else{
                users.push(user);
            }
        })
        messengerVM.userChats = users;
    },
    printAllChats: () => {
        apiManager.getAllChats(messengerVM.currentUser).then(data=>{
            const chats = data.data;
            chats.forEach(chat => {
                if(chat.from.id !== messengerVM.currentUser){
                    messengerVM.userChats.push(chat.from);
                    const profileHtml = messengerVM.getProfileView(chat.from);
                    messengerVM.usersBlock.appendChild(profileHtml);
                }
                else{
                    messengerVM.userChats.push(chat.to);
                    const profileHtml = messengerVM.getProfileView(chat.to);
                    messengerVM.usersBlock.appendChild(profileHtml);
                }
            })
        }).catch(e=>{
            console.log(e);
        })
    }
}
document.addEventListener("DOMContentLoaded", () => {
    Echo.private('users')
        .listen('UserGetByName', (e) => {
            messengerVM.printProfiles(e.users);
        });
    const sender = document.getElementById("messageSender");
    const message = document.getElementById("message");
    const searchInput = document.getElementById("search-message");

    if (messengerVM.currentChat && messengerVM.currentChat.id != null) {
        messengerVM.printAllMessages(messengerVM.currentChat.id);
    }
    if (messengerVM.currentUser !== null){
        messengerVM.printAllChats();
    }
    sender.addEventListener("click", () => messengerVM.sendMessage(message));

    searchInput.addEventListener("input", (e) => {
        apiManager.getUserByName(e.target.value)
    })

    message.addEventListener("keyup", (e) => {
        e.preventDefault();
        if (e.key === 'Enter') {
            sender.click()
        }
    });
})

