//zarządzanie ciasteczkami

//ustawiwanie ciasteczek
const setCookies = () => {
    let date = new Date();
    //ważność ciasteczek na 1h
    date.setTime(date.getTime() + (60 * 60 * 1000));
    let expirationDate = 'expires=' + date.toUTCString();
    //sesja użytkownika status
    document.cookie = 'sesja=F9827HR494;' + expirationDate + ';';
}

//korzystanie z danych z ciasteczek
//funkcja splitująca dane różnych ciasteczek do wywołania indywidualnie
const getCookie = (cookie) => {
    let cookieName = cookie + "=";
    let allCookies = document.cookie.split('; ');
    allCookies.forEach(value => {
      if (value.indexOf(cookieName) === 0)
        finalValue = value.substring(cookieName.length);
    })
    return finalValue;
}

//funkcja do ciasteczek zarządzających sortowaniem
const getCookies = (cookie) => {
    let cookieArr = document.cookie.split(";");
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if(cookie == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

//sprawdzanie statusu użytkownika (czy zalogowany)
const checkStatus = () => {
    if (getCookies('sesja')!=null) {
        window.alert("Jesteś zalogowany!");
        window.location.href = "index.php";
    }
}

//sprawdzanie statusu użytkownika (czy niezalogowany)
const checkStatusRev = () => {
    if (getCookies('sesja')==null) {
        window.alert("Nie jesteś zalogowany!");
        window.location.href = "index.php";
    }
}

//dostosowywanie menu do stanu sesji
const changeNav = () => {
    if (getCookies('sesja')!=null) {
        document.getElementById('loginNav').style.display = 'none';
        document.getElementById('registerNav').style.display = 'none';
        document.getElementById('loginNavBottom').style.display = 'none';
        document.getElementById('registerNavBottom').style.display = 'none';
        document.getElementById('membersNav').style.display = 'none';
        document.getElementById('membersNavBottom').style.display = 'none';
        document.getElementById('accountNav').style.display = 'block';
        document.getElementById('accountNavName').innerHTML = getCookie('login');
        document.getElementById('accountNavBottom').style.display = 'block';
        document.getElementById('accountNavNameBottom').innerHTML = getCookie('login');
        document.getElementById('logoutNav').style.display = 'block';
        document.getElementById('logoutNavBottom').style.display = 'block';
        document.getElementById('createListNav').style.display = 'block';
        document.getElementById('createListNavBottom').style.display = 'block';
        document.getElementById('listsNav').style.display = 'none';
        document.getElementById('listsNavBottom').style.display = 'none';
        document.getElementById('addDataNav').style.display = 'block';
        document.getElementById('addDataNavBottom').style.display = 'block';
    }
}

//zakończenie sesji i usunięcie ciasteczek
const logout = () => {
    // end_session(1);
    document.cookie = "expires= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "sesja= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "login= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "kategoria= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    location.href = "index.php";
}

//stylowanie zależne od sesji indywidualne dla podstrony
const accountHref = () => {
    if (getCookies('sesja')!=null) {
    document.getElementById('accountListsRef').style.display = 'block';
    }
}

//zmiana strony głównej po zalogowaniu użytkownika
const changeMain = () => {
    if (getCookies('sesja')!=null) {
        document.getElementById('main').style.display = 'none';
        document.getElementById('list_main_index').style.display = 'block';
    }
}