import axios from "axios"

const apiManager = {
    sendMessage: (text) => {
        return axios.post("/message", {
            message: text
        });
    },
    getAllMessages: (chatId) => {
        return axios.get("/messages/" + chatId);
    },
    getUserById: (userId) => {
        return axios.get("/user/" + userId);
    }
}
const messengerVM = {
    messageBlock: document.getElementById("messages"),
    sendMessage: (input) => {
        const text = input.value
        apiManager.sendMessage(text).then(data => {
            messengerVM.appendMessage(data)
        }).catch(e => {
            console.log(e);
        });
        input.value = "";
        return false;
    },
    appendMessage: (message) => {
        const messenger = messengerVM.messageBlock;
        if(message.data){
            apiManager.getUserById(message.data.user_id).then(user=>{
                messenger.appendChild(messengerVM.getMessageView(message.data,user.data,true));
                messenger.scrollTo(0, messenger.scrollHeight);
            }).catch(e=>{
                console.log(e);
            });
        }
    },
    getMessageView: (message,user,isLeft) => {
        const elem = document.createElement('li');
        elem.innerHTML = `<img class="low-user-image" src="${messengerVM.getUserAvatar(user)}" alt="profile">
            <div class="message">
                <span class="message-text">${message.text}</span>
            </div>`;
        elem.classList.add("message-block");
        if(isLeft){
            elem.classList.add("left-message");
        }
        else{
            elem.classList.add("right-message");
        }
        return elem;
    },
    getUserAvatar: (user) => {
        return `https://www.gravatar.com/avatar/md5${user.email}?d=https://ui-avatars.com/api/${user.username}/128/random`;
    }
}
document.addEventListener("DOMContentLoaded", () => {
    Echo.private('chat')
        .listen('MessageSend', (e) => {
            console.log(e)
        });
    const sender = document.getElementById("messageSender");
    const message = document.getElementById("message");
    sender.addEventListener("click",() => messengerVM.sendMessage(message));

    message.addEventListener("keyup", (e) => {
        e.preventDefault();
        if (e.key === 'Enter') {
            sender.click()
        }
    });
})
