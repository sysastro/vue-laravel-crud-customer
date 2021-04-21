<template>
  <div class='container py-4'>
    <div class='row justify-content-center'>
      <div class='col-md-6'>
        <div class='card'>
          <div class='card-header'>Detail Customer</div>
          <div class='card-body'>
            <div class='form-group'>
              <label htmlFor='name'>Name</label>
              <input type="text" class="form-control" id="name" v-model="customer.name" disabled>
            </div>
            <div class='form-group'>
              <label htmlFor='email'>Name</label>
              <input type="text" class="form-control" id="email" v-model="customer.email" disabled>
            </div>
            <div class='form-group'>
              <label htmlFor='gender'>Gender</label>
              <input type="text" class="form-control" id="gender" v-model="customer.gender" disabled>
            </div>
            <div class='form-group'>
              <label htmlFor='is_married'>Is Married</label>
              <input type="text" class="form-control" id="is_married" v-model="customer.is_married" disabled>
            </div>
            <div class='form-group'>
              <label htmlFor='address'>Address</label>
              <textarea type="text" class="form-control" id="address" v-model="customer.address" rows="5" disabled></textarea>
            </div>
            <div class='form-group'>
              <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data(){
      return {
        customer:{},
      }
    },
    created() {
      this.axios.get(`/api/customers/show/${this.$route.params.id}`).then((response) => {
        this.customer = response.data.result;
        this.customer.is_married = this.customer.is_married == '1' ? 'Ya' : 'Tidak';
        this.customer.gender = this.customer.gender == 'M' ? 'Male' : 'Female';
      });
    },
    method: {

    }
  }
</script>