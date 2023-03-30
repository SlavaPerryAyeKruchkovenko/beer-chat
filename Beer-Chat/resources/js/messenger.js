import axios from "axios"

const apiManager = {
    sendMessage: (text) => {
        return axios.post("/message", {
            message: text
        });
    },
    getAllMessages: (chatId) => {
        return axios.get("/messages/" + chatId);
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
    appendMessage: (data) => {
        const messenger = messengerVM.messageBlock;

    },
    getMessageView: (text) => {

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
