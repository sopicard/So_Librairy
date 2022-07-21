
//1- Tester la page JS (en vérifiant l'affichage dans la console du navigateur)
//      console.log('test js');
//Penser  à VIDER LE CACHE (ctrl F5 ?) sur le navigateur pour lui effacer mémoire CSS

//2- Je cible le document et je met un écouteur d'évènement au "click"
//      document.addEventListener('click', function (){
//
// });

//3- Je crée une variable qui cible mon btn night mode grâce à sa classe JS
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
    }else {

//9- je mets mon point 6 dans mon else
        body.classList.add('night-activated');
    }
});
//6- A ma var body(js) j'ajoute une class css
//    body.classList.add('night-activated');

//7- Je mets ma classe night-activated dans mon _header.scss
//     si je souhaite que les paramètres sccs des classes JS passent en priorité,
//     je peux ajouter !important juste après la valeur (ex: color: whitesmoke !important;)