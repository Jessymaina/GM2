// Wait for the DOM to be fully loaded before executing the JavaScript code
document.addEventListener('DOMContentLoaded', function () {
    // Select the search form element using its class
    let searchForm = document.querySelector('.search-form');

    // Select the search button element using its ID
    let searchBtn = document.querySelector('#search-btn');

    // Hide the search form initially by adding the 'hidden' class
    searchForm.classList.add('hidden');

    // Add a click event listener to the search button
    searchBtn.addEventListener('click', function () {
        // Toggle the visibility of the search form by adding or removing the 'hidden' class
        searchForm.classList.toggle('hidden');
    });
});

// Wait for the DOM to be fully loaded before executing the JavaScript code
document.addEventListener('DOMContentLoaded', function () {
    // Select the search form element using its class
    let shoppingcart = document.querySelector('.shopping-cart-container');

    // Select the search button element using its ID
    let cartBtn = document.querySelector('#cart-btn');

    // Hide the search form initially by adding the 'hidden' class
    shoppingcart.classList.add('hidden');

    // Add a click event listener to the search button
    cartBtn.addEventListener('click', function () {
        // Toggle the visibility of the search form by adding or removing the 'hidden' class
        shoppingcart.classList.toggle('hidden');
        console.log('show cart');
    });
});
