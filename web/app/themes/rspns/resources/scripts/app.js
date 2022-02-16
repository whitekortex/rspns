import {domReady} from '@scripts/components';
import {createApp} from 'vue';
import ContactUs from '@scripts/vue/ContactUs.vue';

const app = createApp(ContactUs)
app.mount('#vue-contact');

/**
 * Run the application when the DOM is ready.
 */
domReady(() => {
  // Application code.
});

/**
 * Accept module updates
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
import.meta.webpackHot?.accept(console.error);
