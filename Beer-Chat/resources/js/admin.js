const axios = require("axios");

const apiManager = {
    getUserByName: (name) => {
        return axios.get("/user/" + name);
    },
    getUserById: (id) => {
        return axios.get("/user/id/" + id);
    },
    getAllChats: (userId) => {
        return axios.get("/chats/" + userId);
    },
    banUser: (userId) => {
        return axios.delete("/user/" + userId);
    },
}

const adminVM = {
    currentUser: Number(document.querySelector('meta[name="user_id"]').content),
    usersBlock: document.getElementById('users'),
    users:[],
    userInfo: document.getElementById("user-info"),
    userChats: document.getElementById("user-chats"),
    openUserPanel: (user) => {
        adminVM.createUserInfo(user);
    },
    createUserChats: (chats,userId) => {
        adminVM.userChats.classList.remove("center")
        adminVM.userChats.innerHTML = "";
        chats.forEach(value=>{
            if(value.from.id === userId){
                const userChat = adminVM.createUserChat(value.to);
                adminVM.userChats.appendChild(userChat);
            }
            else{
                const userChat = adminVM.createUserChat(value.from);
                adminVM.userChats.appendChild(userChat);
            }
        })
    },
    createUserChat: (user) => {
        const profile = document.createElement('li');
        profile.classList.add("profile");
        profile.innerHTML = `
            <img class="user-image" src="${adminVM.getUserAvatar(user)}" alt="profile">
            <span class="profile-name">${user.username}</span>`
        return profile;
    },
    createUserInfo: (user) => {
        adminVM.userInfo.classList.remove("center")
        adminVM.userInfo.innerHTML = `
            <img class="big-user-image" src="${adminVM.getUserAvatar(user)}" alt="profile">
            <ul class="text-user-info">
                <li class="text-field" id="u_username">${user.username}</li>
                <li class="text-field" id="u_name">${user.name}</li>
                <li class="text-field" id="u_email">${user.email}</li>
                <li class="text-field" id="u_role">
                    <select id="r_selector" class="select-css">
                        <option value=”admin” ${user.role_id===2?"selected":""}>admin</option>
                        <option value=”user” ${user.role_id===1?"selected":""}>user</option>
                        <option value=”fsb” ${user.role_id===3?"selected":""}>fsb</option>
                    </select>
                </li>
            </ul>
            <button class="ban-button" id="ban-btn">Ban</button>`
        const banBtn = adminVM.userInfo.querySelector("#ban-btn");
        banBtn.addEventListener("click",()=>{
            apiManager.banUser(user.id).then(value=>{
                console.log(value)
            })
        });
    },
    getProfileView:(user) => {
        const profile = document.createElement('div');
        profile.setAttribute("id", `user${user.id}`);
        profile.classList.add("profile");
        profile.innerHTML = `
            <img class="min-user-image" src="${adminVM.getUserAvatar(user)}" alt="profile">
            <span class="profile-name">${user.name}</span>`;
        profile.addEventListener("click", () => {
            apiManager.getUserById(user.id).then(value => {
                adminVM.openUserPanel(value.data)
            }).catch(e=>{
                console.log(e);
            })
            apiManager.getAllChats(user.id).then(value => {
                adminVM.createUserChats(value.data,user.id);
            }).catch(e=>{
                console.log(e);
            })
        })
        return profile;
    },
    printProfiles: (users) => {
        users.forEach(user => {
            const haveUser = adminVM.users.find(x => x.id === user.id);
            if (!haveUser && user.id !== adminVM.currentUser) {
                adminVM.users.push(user);
                const profileHtml = adminVM.getProfileView(user);
                adminVM.usersBlock.appendChild(profileHtml);
            }
        })
        adminVM.users.forEach(user => {
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
        adminVM.users = users;
    },
    getUserAvatar: (user) => {
        return `https://www.gravatar.com/avatar/${MD5(user.email)}?d=https://ui-avatars.com/api/${user.username}/128/random`;
    },
}

document.addEventListener("DOMContentLoaded", () => {
    Echo.private('users')
        .listen('UserGetByName', (e) => {
            adminVM.printProfiles(e.users);
        });
    const searchInput = document.getElementById("search-message");
    if(searchInput){
        searchInput.addEventListener("input", (e) => {
            apiManager.getUserByName(e.target.value);
        })
    }
});
