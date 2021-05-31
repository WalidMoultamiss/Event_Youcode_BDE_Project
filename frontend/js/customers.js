authUser.all().then(({users}) => {
    const dashUsers = document.querySelector('#Users')
    console.log(users);
    users.map((user) => {
        let tr = document.createElement('tr')
        console.log(user);
        /*html*/
        tr.innerHTML = `
            <td class="td-hover" scope="col">${user.cin}</td>
            <td class="td-hover" scope="col">${user.first_name}</td>
            <td class="td-hover" scope="col">${user.last_name}</td>
            <td class="td-hover" scope="col">${user.phone}</td>
            <td class="td-hover" scope="col">${user.email}</td>
            <td class="td-hover" scope="col">${user.address}</td>
            <td class="td-hover" scope="col">${user.birth_date}</td>
            <td class="td-hover" scope="col">${user.num_passport}</td>
            <td class="td-hover" scope="col">${user.role}</td>
            
        `
        dashUsers.appendChild(tr)
    })
}).catch((err) => {

});

