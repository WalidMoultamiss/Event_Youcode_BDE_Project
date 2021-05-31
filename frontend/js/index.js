


let newUser = new User()

const loginEmail = document.querySelector('#loginEmail')
const loginPassword = document.querySelector('#loginPassword')
const formLogin = document.querySelector('#auth-login');
const formRegister = document.querySelector('#auth-register');


formLogin?formLogin.addEventListener('submit', (e) => {
   e.preventDefault()
   login()
}):null
formRegister?formRegister.addEventListener('submit', (e) => {
   e.preventDefault()
   register()
}):null

function login() {
   newUser.login(loginEmail.value, loginPassword.value)
   setTimeout(() => {
      console.log(newUser.currentUser)
   }, 300);

}

function register() {
   const email = document.querySelector('#registerEmail').value
   const cin = document.querySelector('#registerCin').value
   const first_name = document.querySelector('#registerfirst_name').value
   const last_name = document.querySelector('#registerlast_name').value
   const address = document.querySelector('#registerAddress').value
   const num_passport = document.querySelector('#registerPassport').value
   const birth_date = document.querySelector('#registerBirthday').value
   const phone = document.querySelector('#registerPhone').value
   const password = document.querySelector('#registerPassword').value
   const password_repeat = document.querySelector('#registerRepeatPassword').value

   let data = {
      email,
      cin,
      first_name,
      last_name,
      address,
      num_passport,
      birth_date,
      password,
      phone,
      password_repeat,
      role:"Admin"
   }
 
   newUser.register(data)
}

