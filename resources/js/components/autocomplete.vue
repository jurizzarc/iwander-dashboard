<template>
 <div>
   <div class="input-group">
     <span class="lnr lnr-magnifier" ></span>
     <input type="text" v-model="search" placeholder="Search cities" v-on:keyup="getSearchData" class="form-control" style="margin-left: 15px;"></input>
   </div>

 <div class="dropdown-results" v-if="results.length">
   <div class="dropdown" v-for="result in results" aria-haspopup="true" aria-expanded="false">
       <a class="dropdown-item"><li class="dropdown-item" @click="getResult(result)">{{ result.name }},  {{result.districts.country.name}}</li></a>
   </div>
 </div>
</div>
</template>
<script>
 export default{
   name: 'autocomplete',
  props: ['app'],
  data(){
   return {
    search: '',
    results: [],
   }
  },
  methods: {
    getSearchData(){
        this.results = [];
        if(this.search.length > 0){
         axios.get('/api/search', { params: { search: this.search } })
         .then(response => {
          this.results = response.data;
         });
       }
    },
    getResult(result){
      this.search = '';
      this.results = [];
      console.log(result.name);
      this.$router.replace({name: 'searchIndex', params: { city: result.name }});
    }
  }
}
</script>
