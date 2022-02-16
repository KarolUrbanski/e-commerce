let loggedInStr = "<li class='register-login'><a href='user.php'>Account</a></li><li class='register-login'><a onclick='logout()'>Logout</a></li>";
let loginStr = document.getElementById("LoginPara").innerHTML;

//Check login when page loads
window.onload = checkLogin();

//Checks whether user is logged in.
function checkLogin(){
    let request = new XMLHttpRequest();
    //Create event handler that specifies what should happen when server responds
    request.onload = function(){
        if(request.responseText === "ok"){
            document.getElementById("LoginPara").innerHTML = loggedInStr;

        }
        else{
            console.log(request.responseText);
            document.getElementById("LoginPara").innerHTML  = loginStr;
        }
    };
    //Set up and send request
    request.open("GET", "js/check-session.php");
    request.send();
}
function logout(){
    //Create event handler that specifies what should happen when server responds
    let request = new XMLHttpRequest();
    request.onload = function(){
        checkLogin();
    };
    //Set up and send request
    request.open("GET", "js/logout.php");
    request.send();
}