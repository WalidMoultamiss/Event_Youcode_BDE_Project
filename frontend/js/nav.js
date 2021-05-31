
let infoUser = authUser.getUserInfo()

authUser.getUserByCin(infoUser.cin).then((result) => {
    let userData = authUser.userData
    if (userData) {
        console.log(userData);
        const nav = document.querySelector('nav')
        if (infoUser.role != "Admin") {
            let path = window.location.pathname;
            let page = path.split("/").pop();
            console.log(page);
            if (page == 'myreservations.html') {
                console.log('true');
                /*html*/
                nav.innerHTML = `
                    <div class="d-flex flex-column p-3 text-white bg-dark sidebarNav">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32">
                                <use xlink:href="#bootstrap" />
                            </svg>
                            <span class="fs-4">${userData.first_name.toUpperCase()}</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto mt-5">
                            <li>
                                <a href="/" class="nav-link text-white ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-house-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                        
                            <li>
                                <a href="#" class="nav-link text-white active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                    </svg>
                                    my reservations
                                </a>
                            </li>

                            
                        </ul>
                        <hr>
                        <div class="dropdown">
                            <div class="d-flex align-items-center text-white text-decoration-none">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong onclick="logout()">LOGOUT</strong>
                            </div>

                        </div>
                    </div>
                `
            }else{
                /*html*/
                nav.innerHTML = `
                    <div class="d-flex flex-column p-3 text-white bg-dark sidebarNav">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32">
                                <use xlink:href="#bootstrap" />
                            </svg>
                            <span class="fs-4">${userData.first_name.toUpperCase()}</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto mt-5">
                            <li>
                                <a href="#" class="nav-link text-white active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-house-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                        
                            <li>
                                <a href="assets/pages/myreservations.html" class="nav-link text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                    </svg>
                                    my reservations
                                </a>
                            </li>

                            
                        </ul>
                        <hr>
                        <div class="dropdown">
                            <div class="d-flex align-items-center text-white text-decoration-none">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong onclick="logout()">LOGOUT</strong>
                            </div>

                        </div>
                    </div>
                `
            }


        } else {
            let username = document.querySelector('#sidebarUsername').innerHTML = userData.first_name.toUpperCase()
        }
    }
})


const logout = () => {
    localStorage.removeItem('Token')
    location.replace('/assets/pages/login.html')
}




let chapter = document.querySelector('#bar')
chapter.addEventListener('click', () => {
    chapter.classList.toggle('open');
    document.querySelector('#page-content-wrapper').classList.toggle('toggled')
    document.querySelector('#sidebar-wrapper').classList.toggle('toggled')
});
