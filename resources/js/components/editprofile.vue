<template>
  <transition name="modal">
      <div class="modal-mask">
          <div class="modal-wrapper">
              <div class="modal-container">
                  <div class="modal-body">
                      <div class="col-12">
                          <div class="modal-form-heading">
                              <h4>Edit Avatar</h4>

                          </div>
                      </div>
                      <div class="col-12">
                          <form v-on:submit.prevent="uploadImage" enctype="multipart/form-data">
                              <div class="form-row">

                                  <div class="form-group col-lg-12 col-sm-12">
                                    <div class="custom-file">
                                        <input required type="file" name="image" v-on:change="newImage" class="custom-file-input" id="image" autocomplete="image">
                                        <label class="custom-file-label" for="image">Profile Image</label>
                                    </div>
                                  </div>

                                  <div class="col-lg-3 col-sm-6">
                                      <button type="submit" class="btn btn-primary">Add</button>
                                  </div>

                                  <div class="col-lg-3 col-sm-6">
                                      <button type="button" class="btn btn-secondary" @click="$emit('close')" >Cancel</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </transition>
</template>
<script>
export default{
  name: 'editprofile',
  // props: ['user'],
  components: {},
  data(){
    return{
      user: {},
      // default: true
    }
  },
  created(){
      let app = this;
      let token = localStorage.getItem("token");
      axios.get('/api/user',{
        headers: { Authorization: "Bearer " + token }
      })
      .then(response => {
        // console.log("USER");
        console.log('user:', response.data.user);
        app.user = response.data.user;
      })
      .catch(function(error){
        console.log(error);
      });
    },
    methods:{
    newImage(){
      let file = event.target.files[0];
      this.user.image = file;
    },
    uploadImage(){
      let app = this;
      let token = localStorage.getItem("token");

      let data = new FormData();
      data.append('name', app.user.name);
      data.append('email', app.user.email);
      data.append('password', app.user.password);
      data.append('image', app.user.image);
      axios.post('/api/profile', data, {
        headers: { 'Authorization': "Bearer " + token,
                    'Content-Type': 'multipart/form-data'}
      })
      .then(res => {
        console.log(res);
        app.$emit('submit');
        // app.default = false;

      })
      .catch(function(error){
          console.log(error);
      });
    }
  }
}
</script>
<style>

</style>
