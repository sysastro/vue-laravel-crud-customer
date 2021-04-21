<template>
  <div class='container py-4'>
    <div class='row justify-content-center'>
      <div class='col-md-8'>
        <div class='card'>
          <div class='card-header'>All Customer</div>
          <div class='card-body'>
            <router-link :to="{ name: 'create' }" class="btn btn-primary">Create new customer</router-link>
            <br/>
            <br/>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="50" class="text-center">No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th width="200" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(customer, index) in customers" :key="customer.id">
                  <td width="50" class="text-center">{{ index + 1 }}</td>
                  <td>{{ customer.name }}</td>
                  <td>{{ customer.email }}</td>
                  <td>{{ customer.gender == 'M' ? 'Male' : 'Female' }}</td>
                  <td width="200" class="text-center">
                    <div class="btn-group">
                      <router-link :to="{name: 'show', params: { id: customer.id }}" class="btn btn-primary">Detail</router-link>
                      <router-link :to="{name: 'edit', params: { id: customer.id }}" class="btn btn-success">Edit</router-link>
                      <button class="btn btn-danger" @click = "deleteCustomer(customer.id)">Delete</button>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        customers: []
      }
    },
    created() {
      let uri = 'api/customers';
      this.axios.get(uri).then(response => {
        this.customers = response.data.result;
      });
    },
    methods: {
      deleteCustomer(id)
      {
        let vc = this;
        vc.$swal.fire({
          title: 'Are you sure ?',
          text: "If deleted, data can't rollback again !!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.value) {
            vc.$swal.fire({
              title: 'Success!',
              text: 'Customer deleted successfully',
              icon: 'success',
              timer: 1000
            });
            vc.axios.delete(`api/customers/delete/${id}`).then(response => {
              vc.customers.splice(this.customers.indexOf(id), 1);
            });
            console.log("Deleted customer with id ..." +id);
          }
        })
      }
    }
  }
</script>