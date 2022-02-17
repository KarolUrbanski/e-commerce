 function getBasket(){
        let basket;
        if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
            basket = [];
        }
        else {
            basket = JSON.parse(sessionStorage.basket);
        }
        return basket;
    }
function addToBasket(prodID, prodname){
    let basket = getBasket();//Load or create basket
    
    //Add product to basket
    basket.push({id: prodID,name: prodname, quantity: 1});
    
    //Store in local storage
    sessionStorage.basket = JSON.stringify(basket);
        
}