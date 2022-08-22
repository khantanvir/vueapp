<template>
    
 <div class="container">
  <h1>Product List </h1><br>
  <h2>Bordered Table</h2>
  <p>The .table-bordered class adds borders on all sides of the table and the cells:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Photo</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody v-if="products.length > 0">
        <tr class="list" v-for="item in products" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td><img :src="ourImage(item.photo)"/></td>
            <td>{{ item.type }}</td>
            <td>{{ item.price }}</td>
            <td>{{ item.quantity }}</td>
            <td>Add | Edit</td>
        </tr>
    </tbody>
    <tbody v-else>
        <div>Product Not Found</div>
    </tbody>
  </table>
</div>
</template>
<script setup>
import { onMounted, ref } from "vue"
import Service from "../../Config/Service.js"

const { getUrl } = Service()

//const site_url = Service.getMain
let products = ref([])
onMounted(async () => {
    getProducts()
})

const getProducts = async () => {
    let response = await axios.get('/vueapp/api/products')
    products.value = response.data.products
    console.log(products.value)
}
const ourImage = (img) =>{
  return getUrl+'public/upload/'+img;
}

</script>