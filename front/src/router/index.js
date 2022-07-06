import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '@/views/HomeView'
// Customers
import ListCustomersView from '@/views/Customers/ListCustomersView.vue'
import EditCustomersView from '@/views/Customers/EditCustomersView.vue'
import CreateCustomersView from '@/views/Customers/CreateCustomersView.vue'
import ViewCustomersView from '@/views/Customers/ViewCustomersView.vue'
// Products
import ListProductsView from '@/views/Products/ListProductsView.vue'
import CreateProductsView from '@/views/Products/CreateProductsView.vue'
import EditProductsView from '@/views/Products/EditProductsView.vue'
import ViewProductsView from '@/views/Products/ViewProductsView.vue'
// Orders
import ListOrdersView from '@/views/Orders/ListOrdersView.vue'
import CreateOrdersView from '@/views/Orders/CreateOrdersView.vue'
import EditOrdersView from '@/views/Orders/EditOrdersView.vue'
import ViewOrdersView from '@/views/Orders/ViewOrdersView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  // Customers ----------------------------------------
  {
    path: '/customers',
    name: 'listCustomers',
    component: ListCustomersView
  },
  {
    path: '/customers/:id/edit',
    name: 'editCustomers',
    component: EditCustomersView
  },
  {
    path: '/customers/:id/details',
    name: 'viewCustomers',
    component: ViewCustomersView
  },
  {
    path: '/customers/create',
    name: 'createCustomers',
    component: CreateCustomersView
  },
  // Products -----------------------------------------
  {
    path: '/products',
    name: 'listProducts',
    component: ListProductsView
  },
  {
    path: '/products/create',
    name: 'createProducts',
    component: CreateProductsView
  },
  {
    path: '/products/:id/edit',
    name: 'editProducts',
    component: EditProductsView
  },
  {
    path: '/products/:id/details',
    name: 'viewProducts',
    component: ViewProductsView
  },
  // Orders -------------------------------------------
  {
    path: '/orders',
    name: 'listOrders',
    component: ListOrdersView
  },
  {
    path: '/orders/create',
    name: 'createOrders',
    component: CreateOrdersView
  },
  {
    path: '/orders/:id/edit',
    name: 'editOrders',
    component: EditOrdersView
  },
  {
    path: '/orders/:id/details',
    name: 'viewOrders',
    component: ViewOrdersView
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
