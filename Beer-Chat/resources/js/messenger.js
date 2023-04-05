const axios = require("axios");
const feather = require("feather-icons")
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
    openChats: [],
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
        document.addEventListener('contextmenu', closeMenu,true);
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
            if(!messengerVM.openChats.find(x=>x.id === messengerVM.currentChat.id)){
                messengerVM.openChats.push({id:messengerVM.currentChat.id})
                Echo.private(`chat.${messengerVM.currentChat.id}`)
                    .listen('MessageSend', (e) => {
                        messengerVM.appendMessage(e.message, e.user);
                    });
                Echo.private(`chat.${messengerVM.currentChat.id}`)
                    .listen('MessageDelete', (e) => {
                        messengerVM.deleteMessageView(e.message.id);
                    });
            }

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
    if(sender){
        sender.addEventListener("click", () => messengerVM.sendMessage(message));
    }
    if(searchInput){
        searchInput.addEventListener("input", (e) => {
            apiManager.getUserByName(e.target.value);
        })
    }

    if(message){
        message.addEventListener("keyup", (e) => {
            e.preventDefault();
            if (e.key === 'Enter') {
                sender.click()
            }
        });
    }

})

