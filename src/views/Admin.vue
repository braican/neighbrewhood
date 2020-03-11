<template>
  <div>
    <form @submit="submit">
      <label>
        Brewery
        <input v-model="brewery" type="text">
      </label>

      <label>
        Street
        <input v-model="street" type="text">
      </label>

      <label>
        City
        <input v-model="city" type="text">
      </label>

      <label>
        State
        <select v-model="state">
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="DC">District of Columbia</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA" selected>Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
      </label>

      <label>
        Zip
        <input v-model="zip" type="number">
      </label>

      <button>
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import Request from '@/utils/request';

export default {
  name: 'Admin',
  data() {
    return {
      brewery: '',
      street: '',
      city: '',
      state: '',
      zip: null,
    };
  },
  computed: {
    ...mapState(['breweries']),
  },
  methods: {
    submit(event) {
      event.preventDefault();

      if (!this.street || !this.city || !this.state || !this.zip) {
        throw new Error('Please fill out all fields.');
      }

      const address = [this.street, this.city, this.state, this.zip].join(', ');
      const breweryRecord = {
        name: this.brewery,
        state: this.state,
        city: this.city,
        zip: this.zip,
        address: address,
      };

      new Request().addBrewery(breweryRecord)
        .then(() => {
          console.log('Record added'); // eslint-disable-line
          this.brewery = '';
          this.street = '';
        })
        .catch(error => console.error('Error', error));
    },
  },
};
</script>

<style lang="scss" scoped>
form {
  width: 100%;
  max-width: 600px;
  margin: 2rem auto;
  padding-left: 2rem;
  padding-right: 2rem;
}

label {
  display: block;
  margin-bottom: 2rem;
}
input,
textarea {
  width: 100%;
  display: block;
  border: 1px solid #999;
  padding: 4px;
}
</style>
