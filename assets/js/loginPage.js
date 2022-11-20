const errorLogin = document.getElementById('alertLogin')
const errorRegister = document.getElementById('alertRegister')

const loginBtn = document.getElementById('login')
const registerBtn = document.getElementById('register')

// NOTE Login
loginBtn.addEventListener('click', (e) => {
    let username = document.getElementById('usernameLogin').value
    let password = document.getElementById('passwordLogin').value
    e.preventDefault()
    fetch('include_file/api.php', {
        method: 'POST',
        body: JSON.stringify({
            'method': 'login',
            'username': username,
            'password': password,
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(response => {
        response.json().then(data => {
            if (data['response'] == 1) {
                location.reload();
            } else if (data['response'] == 0) {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-danger alert-dismissible" role="alert">`,
                    `   <div>${data['data']}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                errorLogin.innerHTML = ''
                errorLogin.append(wrapper)
            }
        })
    })
})

// NOTE Register
registerBtn.addEventListener('click', (e) => {
    let username = document.getElementById('usernameRegister').value
    let password = document.getElementById('passwordRegister').value
    let password2 = document.getElementById('password2Register').value
    e.preventDefault()
    fetch('include_file/api.php', {
        method: 'POST',
        body: JSON.stringify({
            'method': 'register',
            'username': username,
            'password': password,
            'password2': password2,
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(response => {
        response.json().then(data => {
            if (data['response'] == 1) {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-success alert-dismissible" role="alert">`,
                    `   <div>${data['data']}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                errorRegister.innerHTML = ''
                errorRegister.append(wrapper)
                setTimeout(() => {
                    location.reload()
                }, 2000)
            } else if (data['response'] == 0) {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-danger alert-dismissible" role="alert">`,
                    `   <div>${data['data']}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                errorRegister.innerHTML = ''
                errorRegister.append(wrapper)
            }
        })
    })
})