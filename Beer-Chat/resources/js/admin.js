const axios = require("axios");
const feather = require("feather-icons")

const apiManager = {
    getUserByName: (name) => {
        return axios.get("/user/" + name);
    },
}

const adminVM = {
    currentUser: Number(document.querySelector('meta[name="user_id"]').content),
    usersBlock: document.getElementById('users'),
    users:[],
    getProfileView:(user) => {
        const profile = document.createElement('div');
        profile.setAttribute("id", `user${user.id}`);
        profile.classList.add("profile");
        profile.innerHTML = `
            <img class="min-user-image" src="${adminVM.getUserAvatar(user)}" alt="profile">
            <span class="profile-name">${user.name}</span>`;
        profile.addEventListener("click", () => {
            //TODO open user profile
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
