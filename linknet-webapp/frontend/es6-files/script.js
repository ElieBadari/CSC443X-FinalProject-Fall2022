
const base_URL = "http://127.0.0.1:8000/api/";

const web_pages = {};
 

web_pages.loadFor = (page) => {
    eval("workshop_pages.load_" + page + "();");
}

web_pages.load_signup = () => {
    const btn = document.getElementById('btn');
    const email = document.getElementById('email');
    const password = document.getElementById('pass');
    const username = document.getElementById('user');
    
    const signup = async () => {

        let form_data = new FormData();
        let signup_response = {};

        form_data.append('username', username.value);
        form_data.append('email', email.value);
        form_data.append('password', password.value);

        await axios({
            method: "post",
            url: base_URL + "signup",
            data: form_data,
            headers: { "Content-Type": "multipart/form-data" }
        
            }).then(function(response){
                signup_response = response.data;
                
            }).catch(function(error) {
                console.log(error);
            });  

            
    }
    btn.addEventListener('click', signup);

}

web_pages.load_signin = () => {
   
}

web_pages.load_home = () => {
   
}

web_pages.load_profile = () => {
   
}

web_pages.load_lounge = () => {

}
