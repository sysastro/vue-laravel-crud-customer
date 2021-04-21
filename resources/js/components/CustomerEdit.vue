<template>
  <div class='container py-4'>
    <div class='row justify-content-center'>
      <div class='col-md-6'>
        <div class='card'>
          <div class='card-header'>Edit Customer</div>
          <div class='card-body'>
            <div class="alert alert-danger" v-if="errors.length">
              <b>There is error input data:</b>
              <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
              </ul>
            </div>

            <form @submit.prevent="updateCustomer">
              <div class='form-group'>
                <label htmlFor='name'>Name</label>
                <input type="text" class="form-control" id="name" v-model="customer.name">
              </div>
              <div class='form-group'>
                <label htmlFor='email'>Email</label>
                <input type="text" class="form-control" id="email" v-model="customer.email">
              </div>
              <div class='form-group'>
                <label htmlFor='password'>Password</label>
                <input type="password" class="form-control" id="password" v-model="customer.password">
              </div>
              <div class='form-group'>
                <label htmlFor='gender'>Gender</label>
                <div class="input-group">
                  <input type="radio" class="form-control small" name="gender" value="M" v-model="customer.gender"> Male
                  <input type="radio" class="form-control small" name="gender" value="F" v-model="customer.gender"> Female
                </div>
              </div>
              <div class='form-group'>
                <label htmlFor='is_married'>Is Married</label>
                <div class="input-group">
                  <input type="checkbox" class="form-control" id="is_married" name="is_married" value="1" v-model="customer.is_married"> Married
                </div>
              </div>
              <div class='form-group'>
                <label htmlFor='address'>Address</label>
                <textarea type="text" class="form-control" id="address" v-model="customer.address" rows="5"></textarea>
              </div>
              <div class='form-group'>
                <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
                <button class='btn btn-primary'>Update</button>
              </div>
            </form>
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
        errors: [],
        title: null,
        content: null,
      }
    },
    created() {
      this.axios.get(`/api/customers/show/${this.$route.params.id}`).then((response) => {
        this.customer = response.data.result;
      });
    },
    methods: {
      updateCustomer(e){
        let vc = this;
        vc.errors = [];
        if (_.isEmpty(vc.customer.name) || _.isEmpty(vc.customer.email)) {
          vc.errors.push('Name, Email required !');
          return false;
        }
        vc.$swal.fire({
          title: 'Success',
          text: "Customer updated successfully",
          icon: 'success',
          timer: 1000
        });
        vc.axios.put(`/api/customers/update/${this.$route.params.id}`, vc.customer).then((response) => {
          vc.$router.push({name: 'home'});
        });
        return true;
        e.preventDefault();
      }
    }
  }
</script>