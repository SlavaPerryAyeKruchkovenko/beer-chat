import axios from "axios"

const apiManager = {
    sendMessage: (text) => {
        return axios.post("/message",{
            message:text
        });
    },
    getAllMessages: (chatId) => {
        return axios.get("/messages/"+chatId);
    }
}
document.addEventListener("DOMContentLoaded", () => {
    Echo.private('chat')
        .listen('MessageSend', (e) => {
            console.log(e)
        });

    const messageSender = document.getElementById("messageForm");
    messageSender.onclick = (e) => {
        e.preventDefault()
        const messageInput = document.getElementById("message");
        apiManager.sendMessage(messageInput.value).then(data=>{
            console.log(data)
        }).catch(e=>{
            console.log(e)
        });
        return false;
    }
})
