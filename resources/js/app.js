import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
|--------------------------------------------------------------------------
| PWA
|--------------------------------------------------------------------------
*/

if ('serviceWorker' in navigator) {

  window.addEventListener('load', () => {

    navigator.serviceWorker
      .register('/serviceworker.js')

      .then(() => {

        console.log('PWA Ready');

      })

      .catch((err) => {

        console.log(err);

      });

  });

}