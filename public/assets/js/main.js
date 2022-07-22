
//1- Tester la page JS (en vérifiant l'affichage dans la console du navigateur)
//      console.log('test js');
//Penser  à VIDER LE CACHE (ctrl F5 ?) sur le navigateur pour lui effacer mémoire CSS

//2- Cibler le document et mettre un écouteur d'évènement au "click"
//      document.addEventListener('click', function (){
//
// });

//10- Cibler le body
const body = document.querySelector('.js_body');
//11- Si le night mode est activé dans le localstorage => vérif avec true ...
if (localStorage.getItem('nightActivated') === 'true') {
    //12- ... alors je l'active avec le css
    body.classList.add('night-activated');
}

//3- Création d'une variable qui cible mon btn night mode grâce à sa classe JS
//      et je peux tester avec un console.log(nightBtn) en commentant le 2.
const nightBtn = document.querySelector('.js_night_mode');

//4- Je reprends mon 2 et je change de cible en remplaçant document par par ma const et je teste avec
//      console.log('click');
nightBtn.addEventListener('click', function() {
    //5- Création nelle var body que je cible avec class JS
    const body = document.querySelector('.js_body');

    //8- Si le mode night-activated est déjà en place, au click, le supprimer, sinon, l'ajouter.
    if(body.classList.contains('night-activated')) {
       body.classList.remove('night-activated');
       //13- Et je supprime le night-mode du localstoarge
       localStorage.removeItem('nightActivated')
    }else {
        //9- Je mets mon point 6 dans mon else
        body.classList.add('night-activated');
        //14- Et j'enregistre le night-mode dans le localstorage
        localStorage.setItem('nightActivated', "true");
    }
});
//6- A ma var body(JS) j'ajoute une class css
//    body.classList.add('night-activated');

//7- Je mets ma classe night-activated dans mon _header.scss
//     si je souhaite que les paramètres sccs des classes JS passent en priorité,
//     je peux ajouter !important juste après la valeur (ex: background-color: lightpink !important;)

//12- Création 2 ariables qui ciblent le bouton de la nav mobile et le nav mobile.
const hamburgerButton = document.querySelector(".nav-toggler")
const navigation = document.querySelector(".menu-mobile")

//13- Evènement au click avec fonction toggle qui, si la classe existe il l'a supprime sinon il l'a crée.
hamburgerButton.addEventListener("click",toggleNav)

function toggleNav(){
    hamburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}