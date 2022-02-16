<template>
  <div>


    <!-- success state here -->
    <div class="contact__success" v-if="success">
      <h2 class="success__title">Thank you for your comments.</h2>
      <p class="success__desc">We will get back to you soon.</p>
    </div>
    <!-- end success state -->

    <form
      action=""
      @submit.prevent="submitForm"
      v-if="!success"
      class="grid grid-cols-1 gap-6"
    >
      <fieldset>
        <label class="block" for="name">
          Name:
          <input
            type="text"
            required="required"
            name="name"
            id="name"
            v-model="fields.name"
            class="
              mt-1
              block
              w-full
              rounded-md
              bg-gray-100
              border-transparent
              focus:border-gray-500 focus:bg-white focus:ring-0
            "
          />
        </label>
        <span class="error__label" v-if="errors['name']">{{
          errors['name']
        }}</span>
      </fieldset>

      <fieldset>
        <label class="block" for="email">
          Email:
          <input
            type="email"
            required="required"
            name="email"
            id="email"
            v-model="fields.email"
            class="
              mt-1
              block
              w-full
              rounded-md
              bg-gray-100
              border-transparent
              focus:border-gray-500 focus:bg-white focus:ring-0
            "
            placeholder="john@example.com"
          />
        </label>
        <span class="error__label" v-if="errors['email']">{{
          errors['email']
        }}</span>
      </fieldset>

      <fieldset>
        <label class="block" for="phone">
          Phone:
          <input
            type="tel"
            required="required"
            name="phone"
            id="phone"
            pattern="^[0-9-+s()]*$"
            class="
              form-input
              mt-1
              block
              w-full
              rounded-md
              bg-gray-100
              border-transparent
              focus:border-gray-500 focus:bg-white focus:ring-0
            "
            v-model="fields.phone"
          />
        </label>
        <span class="error__label" v-if="errors['phone']">{{
          errors['phone']
        }}</span>
      </fieldset>

      <fieldset>
        <label class="block" for="route">
          Contacting about:
          <select
            required="required"
            v-model="fields.route"
            class="
              block
              w-full
              mt-1
              rounded-md
              bg-gray-100
              border-transparent
              focus:border-gray-500 focus:bg-white focus:ring-0
            "
          >
            <option
              v-for="(email, option) in routes"
              :key="option"
              :value="{email: email, option: option}"
            >
              {{ option }}
            </option>
          </select>
        </label>
        <span class="error__label" v-if="errors['phone']">{{
          errors['phone']
        }}</span>
      </fieldset>

      <fieldset>
        <label class="block" for="message">
          Comments:
          <textarea
            rows="5"
            required="required"
            name="message"
            id="message"
            v-model="fields.message"
            class="
              mt-1
              block
              w-full
              rounded-md
              bg-gray-100
              border-transparent
              focus:border-gray-500 focus:bg-white focus:ring-0
            "
          />
        </label>
        <span class="error__label" v-if="errors['message']">{{
          errors['message']
        }}</span>
      </fieldset>

      <input
        type="submit"
        class="
          mt-1
          block
          w-full
          py-4
          rounded-md
          bg-red-500
          text-white
          border-transparent
          focus:border-gray-500 focus:bg-white focus:ring-0
        "
      />
    </form>
  </div>
</template>


<script>
import axios from 'axios';
import qs from 'qs';

export default {
  components: {},
  props: {},
  data: () => ({
    isIncomplete: true,
    success: false,
    options: ['General Inquiries', 'Feedback', 'Press'],
    routes: {
      'General Inquiries': 'webmaster@response.agency',
      Feedback: 'webmaster@response.agency',
      Press: 'webmaster@response.agency',
    },
    fields: {
      name: null,
      email: null,
      phone: null,
      message: null,
    },
    errors: {
      name: null,
      email: null,
      phone: null,
      restaurant: null,
      message: null,
    },
  }),
  computed: {},
  created() {},
  mounted() {},
  methods: {
    submitForm() {
      if (!Object.values(this.fields).includes(null)) {
        if (this.fields.email.includes('@')) {
          this.isIncomplete = false;
        }
      }

      // if incomplete, return without submitting
      if (this.isIncomplete) return false;

      axios({
        url: '/wp/wp-admin/admin-ajax.php?action=contact_callback',
        method: 'post',
        headers: {'content-type': 'application/x-www-form-urlencoded'},
        data: qs.stringify({
          email: this.fields.email,
          name: this.fields.name,
          phone: this.fields.phone,
          restaurant: this.fields.restaurant,
          message: this.fields.message,
          type: this.fields.route.option,
          route: this.fields.route.email,
        }),
      })
      .then((response) => {
        if (response.data.success) {
          this.success = true;
        } else {
          this.success = false;
        }
      })
      .catch((e) => {
        // could set up some type of logging
        console.log(e)
      });
    },
  },
};
</script>
