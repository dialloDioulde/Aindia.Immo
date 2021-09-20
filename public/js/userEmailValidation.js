
let url_string = window.location.href;
let url = new URL(url_string);

let email = url.searchParams.get("email");
console.log(email);

let token = url.searchParams.get("token");
console.log(token);




