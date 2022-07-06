import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    // Customers ----------------------------------
    customers: [],
    customer: null,
    // Products -----------------------------------
    products: [],
    product: null,
    // Orders -------------------------------------
    orders: [],
    order: null,
    // Generic ------------------------------------
    base: 'http://localhost:20080/api',
    errors: [],
    success: false,
    error: false,
  },
  getters: {
    // Customers ----------------------------------
    getCustomers: (state) => JSON.parse(JSON.stringify(state.customers)),
    getCustomer: (state) => state.customer,
    // Products -----------------------------------
    getProducts: (state) => JSON.parse(JSON.stringify(state.products)),
    getProduct: (state) => state.product,
    // Orders -------------------------------------
    getOrders: (state) => JSON.parse(JSON.stringify(state.orders)),
    getOrder: (state) => state.order,
    // Generic ------------------------------------
    getBase: (state) => state.base,
    getErrors: (state) => JSON.parse(JSON.stringify(state.errors)),
    getError: (state) => state.error,
    getSuccess: (state) => state.success,
  },
  actions: {
    /**
     * Get all the customers.
     */
    async fetchCustomers({commit, state}) {
      try {
        const response = await axios.get(state.base + '/customers', {
          headers: {
            'Accept': 'application/json'
          }
        })
        commit('setCustomers', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Get all the products.
     */
    async fetchProducts({commit, state}) {
      try {
        const response = await axios.get(state.base + '/products', {
          headers: {
            'Accept': 'application/json'
          }
        })
        commit('setProducts', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Get all the orders.
     */
     async fetchOrders({commit, state}) {
      try {
        const response = await axios.get(state.base + '/orders', {
          headers: {
            'Accept': 'application/json'
          }
        })
        commit('setOrders', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Search for customers.
     */
    async searchCustomers({commit, state}, context) {
      try {
        let baseURl = state.base + '/customers/?'
        baseURl = baseURl + `${(context.search.name)? 'name=' + context.search.name + '&': ''}`
        baseURl = baseURl + `${(context.search.cpf)? 'cpf=' + context.search.cpf + '&': ''}`
        baseURl = baseURl + `${(context.search.email)? 'email=' + context.search.email + '&': ''}`
        baseURl = baseURl + `${(context.search.phone)? 'phone=' + context.search.phone + '&': ''}`
        baseURl = baseURl + `${(context.search.birthday)? 'birthday=' + context.search.birthday + '&': ''}`
        baseURl = baseURl + `${(context.search.gender!=0)? 'gender=' + context.search.gender + '&': ''}`
        console.log(baseURl)
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('setCustomers', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Search for products.
     */
     async searchProducts({commit, state}, context) {
      try {
        let baseURl = state.base + '/products/?'
        baseURl = baseURl + `${(context.search.name)? 'name=' + context.search.name + '&': ''}`
        baseURl = baseURl + `${(context.search.description)? 'description=' + context.search.description + '&': ''}`
        baseURl = baseURl + `${(context.search.amount && context.search.amount > 0)? 'amount=' + context.search.amount + '&': ''}`
        baseURl = baseURl + `${(context.search.current_amount && context.search.current_amount >= 0)? 'currentamount=' + context.search.current_amount + '&': ''}`
        baseURl = baseURl + `${(context.search.price && context.search.price >= 0.01)? 'price=' + context.search.price + '&': ''}`
        console.log(baseURl)
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        console.log(response.data)
        commit('setProducts', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Search for orders.
     */
     async searchOrders({commit, state}, context) {
      try {
        let baseURl = state.base + '/orders/?'
        baseURl = baseURl + `${(context.search.customer_id!=0)? 'customer=' + context.search.customer_id + '&': ''}`
        baseURl = baseURl + `${(context.search.product_id!=0)? 'product=' + context.search.product_id + '&': ''}`
        baseURl = baseURl + `${(context.search.value)? 'value=' + context.search.value + '&': ''}`
        baseURl = baseURl + `${(context.search.quantity)? 'quantity=' + context.search.quantity + '&': ''}`
        baseURl = baseURl + `${(context.search.status!=0)? 'status=' + context.search.status + '&': ''}`
        console.log(baseURl)
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('setOrders', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Get the details of an especific customer by their ID.
     */
    async fetchCustomer({commit, state}, context) {
      try {
        let baseURl = state.base + '/customers/' + context.customerID + '/detail'
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        console.log(response.data)
        commit('setCustomer', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Get the details of an especific product by their ID.
     */
     async fetchProduct({commit, state}, context) {
      try {
        let baseURl = state.base + '/products/' + context.productID + '/detail'
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('setProduct', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Get the details of an especific order by their ID.
     */
     async fetchOrder({commit, state}, context) {
      try {
        let baseURl = state.base + '/orders/' + context.orderID + '/detail'
        const response = await axios.get(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('setOrder', response.data)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Update an especific customer by their ID.
     */
    async updateCustomer({commit, state}, context) {
      try {
        let baseURl = state.base + '/customers/' + context.customer.id + '/edit'
        const options = {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        }
        const body = {
          name: context.customer.name,
          cpf: context.customer.cpf,
          gender_id: context.customer.gender_id,
          birthday: context.customer.birthday,
          email: context.customer.email,
          phone: context.customer.phone
        }
        const response = await axios.patch(baseURl, body, options)
        commit('setCustomer', response.data)
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    /**
     * Update an especific product by their ID.
     */
     async updateProduct({commit, state}, context) {
      try {
        let baseURl = state.base + '/products/' + context.product.id + '/edit'
        const options = {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        }
        const body = {
          name: context.product.name,
          description: context.product.description,
          amount: context.product.amount,
          price: context.product.price,
        }
        const response = await axios.patch(baseURl, body, options)
        commit('setProduct', response.data)
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    /**
     * Update an especific order by their ID.
     */
     async updateOrder({commit, state}, context) {
      try {
        let baseURl = state.base + '/orders/' + context.order.id + '/edit'
        const options = {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        }
        const body = {
          customer_id: context.order.customer_id,
          product_id: context.order.product_id,
          quantity: parseInt(context.order.quantity),
          status_id: parseInt(context.order.status_id),
        }
        console.log(body)
        const response = await axios.patch(baseURl, body, options)
        console.log(response.data)
        commit('setOrder', response.data)
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        console.log(error.response.data.errors)
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    /**
     * Delete an especific customer by their ID.
     */
    async deleteCustomer({commit, state}, context) {
      try {
        let baseURl = state.base + '/customers/' + context.customerID + '/delete'
        console.log(baseURl)
        const response = await axios.delete(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('unsetCustomer', response.data.customer_id)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Delete an especific product by their ID.
     */
     async deleteProduct({commit, state}, context) {
      try {
        let baseURl = state.base + '/products/' + context.productID + '/delete'
        console.log(baseURl)
        const response = await axios.delete(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('unsetProduct', response.data.product_id)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Delete an especific order by their ID.
     */
     async deleteOrder({commit, state}, context) {
      try {
        let baseURl = state.base + '/orders/' + context.orderID + '/delete'
        console.log(baseURl)
        const response = await axios.delete(baseURl, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        commit('unsetOrder', response.data.order_id)
      }catch (error) {
        console.log(error)
      }
    },

    /**
     * Store a new customer.
     */
    async storeCustomer({commit, state}, context) {
      try {
        let baseURl = state.base + '/customers/create'
        console.log(baseURl)
        const response = await axios.post(baseURl, context.customer, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        this.dispatch('fetchCustomers')
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    /**
     * Store a new product.
     */
    async storeProduct({commit, state}, context) {
      try {
        let baseURl = state.base + '/products/create'
        console.log(baseURl)
        const response = await axios.post(baseURl, context.product, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        this.dispatch('fetchProducts')
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    /**
     * Store a new order.
     */
    async storeOrder({commit, state}, context) {
      try {
        let baseURl = state.base + '/orders/create'
        console.log(baseURl)
        const response = await axios.post(baseURl, context.order, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        this.dispatch('fetchOrders')
        commit('setSuccess', true)
        commit('setError', false)
      }catch (error) {
        commit('setErrors', error.response.data.errors)
        commit('setSuccess', false)
        commit('setError', true)
      }
    },

    unsetSuccess({commit, state}) {
      commit('setSuccess', false)
    }
  },

  mutations: {
    // Customers ----------------------------------
    setCustomers (state, payload) {
      (Array.isArray(payload))? state.customers = payload: state.customers.push(payload)
    },
    unsetCustomer (state, payload) {
      for(var i = 0; i < state.customers.length; i++) {
        if(state.customers[i].id==payload) state.customers.splice(i, 1)
      }
    },
    setCustomer (state, payload) {
      state.customer = payload
    },
    // Products -----------------------------------
    setProducts (state, payload) {
      (Array.isArray(payload))? state.products = payload: state.products.push(payload)
    },
    unsetProduct (state, payload) {
      for(var i = 0; i < state.products.length; i++) {
        if(state.products[i].id==payload) state.products.splice(i, 1)
      }
    },
    setProduct (state, payload) {
      state.product = payload
    },
    // Orders -------------------------------------
    setOrders (state, payload) {
      (Array.isArray(payload))? state.orders = payload: state.orders.push(payload)
    },
    unsetOrder (state, payload) {
      for(var i = 0; i < state.orders.length; i++) {
        if(state.orders[i].id==payload) state.orders.splice(i, 1)
      }
    },
    setOrder (state, payload) {
      state.order = payload
    },
    // Generic ------------------------------------
    setErrors(state, payload) {
      state.errors = payload
    },
    setError(state, payload) {
      state.error = payload
    },
    setSuccess(state, payload) {
      state.success = payload
    }
  },
})
