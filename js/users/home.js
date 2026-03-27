function logOutBtn(){
    logOut()
}

async function logOut() {
    try{
        const response = await fetch(`./../Ticket/api/users/home.php?logout=${true}`)
        if (!response.ok) {
            throw new Error('Error en la petición HTTP');
        }
        const data = await response.json();
        if(data.code === 0){
            alert("Good bye")
            window.location.reload()
        }
    }catch(error){
        console.log(error)
    }
}