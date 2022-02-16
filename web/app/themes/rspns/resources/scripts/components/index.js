// import Vue from 'vue';
// import Contact from '@scripts/vue/Contact.vue';


/**
 * Calls a supplied function once
 * document has loaded.
 *
 * @param  {CallableFunction} onReady
 * @return {void}
 */
export const domReady = (onReady) => {
  window.requestAnimationFrame(function check() {
    document.body ? onReady() : window.requestAnimationFrame(check);
  });
};
