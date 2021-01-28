import axios from "axios";

export default {
    name: 'Api',
    productStore: '/api/product/store',
    categoryStore: '/api/category/store',
    productUpdate: (id) => '/api/product/'+id,
    isLoggedIn: () => axios.get('/api/authenticated'),
    logout: () => axios.post('/api/user/logout'),
    getCategories: () => axios.get('/api/category'),
    deleteCategory: (id) => axios.delete('/api/category/'+id),
    getProducts: () => axios.get('/api/product'),
    increaseStock: (id) => axios.patch('/api/product/increase/'+id),
    decreaseStock: (id) => axios.patch('/api/product/decrease/'+id),
    deleteProduct: (id) => axios.delete('/api/product/'+id),
    getProduct: (id) => axios.get('/api/product/'+id),
    getStatistics: () => axios.get('/api/product/statistics/report')
}
