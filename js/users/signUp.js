let formLogIn = document.getElementById("signUpForm")
let formData = document.forms['signUpForm']

function isEmpty(data){
    if(data == " " || data == "") return true
    return false
}

formLogIn.addEventListener('submit',(e)=>{
    e.preventDefault()
    if(isEmpty(formData.userName.value) || isEmpty(formData.password.value) || isEmpty(formData.name.value)|| isEmpty(formData.email.value)){
        return
    }
    let userName = formData.userName.value
    let password = formData.password.value
    let name = formData.name.value
    let email = formData.email.value
    console.log(formData.userName.value)
    console.log(formData.password.value)
    console.log(formData.name.value)
    console.log(formData.email.value)
    signUp(userName, password,name,email)
})

async function signUp(userName, password,name,email){
    try {
        const response = await fetch('./../Ticket/api/users/signup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ userName, password, name, email })
        });

        if (!response.ok) {
            throw new Error('Error en la petición HTTP');
        }

        const data = await response.json();

        if (data.status === "ok") {
            console.log("Bienvenido:", data.message);
        } else {
            console.log("Error:", data.message);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}