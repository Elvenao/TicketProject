let formLogIn = document.getElementById("logInForm")
let formData = document.forms['logInForm']

function isEmpty(data){
    if(data == " " || data == "") return true
    return false
}

formLogIn.addEventListener('submit',(e)=>{
    e.preventDefault()
    if(isEmpty(formData.userName.value) || isEmpty(formData.password.value)){
        alert("There are empty fields!")
        return
    }
    userName = formData.userName.value
    password = formData.password.value
    console.log(formData.userName.value)
    console.log(formData.password.value)
    logIn(userName, password)
})

async function logIn(userName, password){
    try {
        const response = await fetch('./../Ticket/api/users/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userName, password })
        });

        if (!response.ok) {
            throw new Error('Error en la petición HTTP');
        }

        const data = await response.json();

        if (data.code === 0) {
            alert("Welcome")
            window.location.reload()
        }else if(data.code === 1){
            alert("Wrong Credentials!")
        } else if(data.code === 2){
            alert("There are empty fields")
        }  else {
            console.log("Error:", data.message);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}